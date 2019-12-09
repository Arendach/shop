<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BasicFilter
{
    const FIELDS = null;
    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @var Request
     */
    protected $request;

    /**
     * CategoryProductFilter constructor.
     * @param Builder $builder
     * @param Request $request
     */
    public function __construct(Builder $builder, Request $request)
    {
        $this->builder = $builder;
        $this->request = $request;

        $data = $this->parseRequest($request);
        foreach ($data as $key => $value)
            if (method_exists($this, $key))
                $this->$key($value);
    }

    /**
     * @return Builder
     */
    public function apply()
    {
        return $this->builder;
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function parseRequest(Request $request): array
    {
        return is_null(self::FIELDS) ? $request->all() : $request->only(self::FIELDS);
    }
}