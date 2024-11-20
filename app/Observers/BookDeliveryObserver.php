<?php

namespace App\Observers;

use App\Models\Book\BookDelivery;

class BookDeliveryObserver
{
    public function created(BookDelivery $bookDelivery): void
    {
        $this->updateBookAvailability($bookDelivery, 1);
    }

    public function updated(BookDelivery $bookDelivery): void
    {
        // dd($bookDelivery);
        // $this->checkAndUpdateBookAvailability($bookDelivery);
    }

    protected function updateBookAvailability(BookDelivery $bookDelivery, $increment)
    {
        if ($bookDelivery->is_new_book && $bookDelivery->is_delivered) {
            $currentAvailable = $bookDelivery->book->yearBook->book_delivered_new;
            $bookDelivery->book->yearBook->book_delivered_new = $currentAvailable + $increment;
        } else {
            $currentAvailable = $bookDelivery->book->yearBook->book_delivered_old;
            $bookDelivery->book->yearBook->book_delivered_old = $currentAvailable + $increment;
        }
        // حفظ التغييرات
        $bookDelivery->book->yearBook->save();
    }

    protected function checkAndUpdateBookAvailability(BookDelivery $bookDelivery)
    {
        // if ($bookDelivery->isDirty('is_delivered')) {
        //     if ($bookDelivery->is_delivered);
        //     $this->updateBookAvailability($bookDelivery, 1);
        // }
    }
}
