<?php

namespace App\Services;

class OrderStatusService
{
    private $statuses;

    /**
     * OrderStatusService constructor.
     */
    public function __construct()
    {
        $this->boot();
    }

    /**
     * @return void
     */
    private function boot(): void
    {
        $this->statuses = asset_data('order_statuses');
    }

    /**
     * @return array
     */
    public function getStatuses(): array
    {
        return $this->statuses;
    }

    /**
     * @param string $key
     * @return array
     */
    public function getStatus(string $key): array
    {
        return $this->statuses[$key];
    }

    /**
     * @param string $key
     * @return string
     */
    public function getName(string $key): string
    {
        return $this->statuses[$key]['name'];
    }

    /**
     * @param string $key
     * @return string
     */
    public function getColor(string $key): string
    {
        return $this->statuses[$key]['color'];
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isUpdate(string $key): bool
    {
        return $this->statuses[$key]['update'];
    }

}