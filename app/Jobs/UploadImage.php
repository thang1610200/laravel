<?php

namespace App\Jobs;

use App\Models\Commission;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Ticket;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadImage extends UploadedFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $image, $name, $quantity, $price, $description, $seller_id;

    public function __construct($image, $name, $quantity, $price, $description, $seller_id)
    {
        //
        $this->image = $image;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->description = $description;
        $this->seller_id = $seller_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        try{
           $upload = cloudinary()->upload(storage_path()."/app/public/".$this->image)->getSecurePath();

            $ticket = new Ticket();
            $ticket->name = $this->name;
            $ticket->quantity = $this->quantity;
            $ticket->price = $this->price;
            $ticket->description = $this->description;
            $ticket->image = $upload;
            $ticket->slug = Str::slug($this->name);
            $ticket->seller_id = $this->seller_id;

            $ticket->save();
            Storage::disk('public')->delete('/' . $this->image);
        }
        catch(Exception $e){
            Log::alert($e->getMessage());
        }
    }
}
