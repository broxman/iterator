<?php
namespace Broxman\Iterator;

/**
 * Interface Pager
 * @package Broxman\Iterator
 */
interface Pager
{
    /**
     * @param int $pageNumber
     * @return array
     */
    public function getPage(int $pageNumber = 0): array;

    /**
     * @return int
     */
    public function getPageSize(): int;

    /**
     * @param int $pageNumber
     * @return mixed
     */
    public function setPageSize(int $pageNumber = 0);
}
