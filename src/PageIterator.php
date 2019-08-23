<?php
namespace Broxman\Iterator;

/**
 * Page Iterator
 */
class PageIterator implements \Iterator
{
    private $_index;
    private $_pageNumber;
    private $_items;
    private $_pager;

    /**
     * PageIterator constructor.
     * @param array $items
     * @param Pager $pager
     */
    public function  __construct(array $items, Pager $pager)
    {
        $this->_items = $items;
        if (count($this->_items)){
            $this->_index = 0;
            $this->_pageNumber = 1;
        }
        $this->_pager = $pager;
    }

    /**
     * returns the current item when iterating with foreach
     *
     * @return mixed
     */
    public function current()
    {
        return $this->_items[$this->_index];
    }

    /**
     * Returns the current item index when iterating with foreach
     *
     * @return int
     */
    public function key()
    {
        return ($this->_pageNumber - 1) * $this->_pager->getPageSize() + $this->_index;
    }

    /**
     * Advances to the next item in the collection when iterating with foreach
     */
    public function next()
    {
        $this->_index++;
    }

    /**
     * Rewinds the testIterateOverResults collection to the first item when iterating with foreach
     */
    public function rewind()
    {
        if ($this->_pageNumber !== 1) {
            $this->_pageNumber = 1;
            $this->_loadPage();
        }
    }

    /**
     * Returns whether the current item is valid when iterating with foreach
     *
     * @return bool
     */
    public function valid()
    {
        if ($this->_index == count($this->_items)) {
            $this->_pageNumber++;
            $this->_loadPage();
        }

        if ($this->_index < count($this->_items)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Loads the page of results for the collection
     */
    private function _loadPage()
    {
        $this->_items = $this->_pager->getPage($this->_pageNumber);
        $this->_index = 0;
    }
}
