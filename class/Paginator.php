<?php

class Paginator {
    private $items;
    private $itemsPerPage;
    private $currentPage;
    private $totalPages;

    public function __construct($items, $itemsPerPage = 5, $currentPage = 1) {
        $this->items = $items;
        $this->itemsPerPage = $itemsPerPage;
        $this->currentPage = max(1, intval($currentPage));
        $this->totalPages = ceil(count($items) / $itemsPerPage);
        
        // Ajustar página actual si está fuera de rango
        if ($this->currentPage > $this->totalPages && $this->totalPages > 0) {
            $this->currentPage = $this->totalPages;
        }
    }

    public function getItems() {
        $offset = ($this->currentPage - 1) * $this->itemsPerPage;
        return array_slice($this->items, $offset, $this->itemsPerPage);
    }

    public function getCurrentPage() {
        return $this->currentPage;
    }

    public function getTotalPages() {
        return $this->totalPages;
    }

    public function hasNextPage() {
        return $this->currentPage < $this->totalPages;
    }

    public function hasPreviousPage() {
        return $this->currentPage > 1;
    }

    public function getTotalItems() {
        return count($this->items);
    }
}
