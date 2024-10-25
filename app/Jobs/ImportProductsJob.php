<?php

namespace App\Jobs;
use App\Models\User;
use App\Notifications\productsuploaded;
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\ALLproducts;
use App\Imports\ProductImport;
use App\Exports\BlankSheetExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
class ImportProductsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;
protected $filePath;
protected $dataChunk;
    /**
     * Create a new job instance.
     */
    public function __construct(array  $dataChunk)
    {
        $this->dataChunk = $dataChunk;
    }

    /**
     * Execute the job.
     */
     /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    
        foreach ($this->dataChunk as $data) {
            // usleep(2000000); 
                $productstable = new ALLproducts();
                $productstable->name = $data['name'];
                $productstable->description = $data['description'];
                $productstable->image = $data['imagepath'];
                $productstable->category = $data['category'];
                $productstable->price = $data['price'];
                $productstable->Total_no_of_product = $data['total_no_of_product'];
                $productstable->sold = 0;
                $productstable->created_at = now();
                $productstable->updated_at = now();
                $productstable->save();
           
        }

        // $user = Auth::user();  // Replace with the actual user ID
        // $details = ['message' => 'Test notification', 'completed_at' => now()];
        // $user->notify(new productsuploaded($user));
    }
    
}


// 23
