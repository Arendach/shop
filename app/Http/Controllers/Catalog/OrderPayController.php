<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderPay;
use Illuminate\Http\Request;
use App\Liqpay\LiqPay;
use Illuminate\Support\Carbon;

class OrderPayController extends Controller
{
    protected $client = null;
    protected $liqpay;
    private $public_key, $private_key;
    public $orderCookie;
    public function __construct(Request $request)
    {
        $this->orderCookie = $request->session()->get('pay_order_id');
        $this->public_key = config('api.liqpay_public_key');
        $this->private_key = config('api.liqpay_private_key');
        $this->client = new LiqPay($this->public_key, $this->private_key);

    }
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $order = Order::find($request->order_id);
        $request->session()->put('pay_order_id', $order->id);
        $dae = base64_encode('email:'.$order->email.'');
        $form_pay = $this->client->cnb_form(array(
            'action'         => 'pay',
            'amount'         => intval($order->sum()),
            'currency'       => 'UAH',
            'description'    => $order->comment ?? 'Оплата заказа №'.$order->id,
            'order_id'       => $order->id,
            'language'       => config('locale.current'),
            'version'        => '3',
            'result_url'     => route('order.pay.success'),
            'dae'            => $dae
        ));
        $canceled = ($request->canceled) ?? false;
        return view('catalog.pay.index', compact('form_pay','order','canceled'));
    }


    public function store(Request $request)
    {
        // Проверка на переменную номера заказа
        if($this->orderCookie === null){
            return redirect()->route('order.pay.error', ['id' =>$this->orderCookie]);
        }
        $signature = base64_encode( sha1($this->private_key . $request->data . $this->private_key,1));
        // Проверка на подлинность транзации.
        if ($signature !== $request->signature){
            dd($signature, $request->all());
            return redirect()->route('order.pay.create', ['order_id' =>$this->orderCookie]);
        }
        // Подготовка API Статуса оплаты
        $res = $this->client->api("request", array(
            'action'        => 'status',
            'version'       => '3',
            'order_id'      =>  $this->orderCookie
        ));
        //Если статус ошибка
        if($res->result == 'error'){
            dd('ERROR');
            return redirect()->route('order.pay.create', ['order_id' =>$this->orderCookie,'canceled'=>1]);
        }
        elseif ($res->result == 'ok'){
            // Изменяем статус в заказах
            $order = Order::find($res->order_id);
            $order->status = 'payment';
            $order->save();
            // Проверяем, есть ли данный заказ в оплатах
            $orderFind = OrderPay::where('order_id', $res->order_id);
            // Если нет, создаем
            if($orderFind->count() == 0) {
                $orderFind = OrderPay::create((array)$res);
                $orderFind->save();
            }else{
                // Если есть, обновляем необходимые данные
                $orderFind = $orderFind->first();
                $orderFind->status = $res->status;
                $orderFind->end_date = $res->end_date;
                $orderFind->save();
            }
            // Реализация отправки Квитанции на E-mail
            $email = ($orderFind->orderShow->email) ? true : false;
            $ticket = $this->client->api("request", array(
                'action'    => 'ticket',
                'version'   => '3',
                'order_id' => $res->order_id,
                'email'   => $orderFind->orderShow->email
            ));

            if($ticket->result = 'ok'){
                setCookie('pay_order_id', '');

            }
            return redirect()->route('order.pay.ok');
        }
        return false;
    }

    public function error() {
        return view('catalog.pay.error', ['order' =>$this->orderCookie]);
    }
    public function success()
    {
        return view('catalog.pay.success');
    }

}
