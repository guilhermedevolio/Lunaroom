<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SaleLog extends Model
{
    protected $table = "sales_logs";

    protected $fillable = ['sale_id', 'field', 'value'];
}
