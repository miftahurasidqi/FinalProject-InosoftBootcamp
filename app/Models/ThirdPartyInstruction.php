<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ThirdPartyInstruction extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'third_party_instructions';
    // protected $primaryKey = '_id';

    protected $fillable = [
        'instructionID',
        'instructionType',
        'linkTo',
        'assignedVendor',
        'attentionOf',
        'vendorAddress',
        'invoiceTo',
        'vendorQuotationNo',
        'customerContract',
        'NoCustomerPO',
        'status',
    ];

    protected $casts = [
        'linkTo' => 'array',

    ];

    public function costDetail()
    {
        return $this->embedsOne(CostDetail::class);
    }

    public function statusInfo()
    {
        return $this->embedsOne(StatusInfo::class);
    }

    public function vendorInvoice()
    {
        return $this->hasMany(VendorInvoice::class);
    }

    public function vendorAddress()
    {
        return $this->belongsTo(VendorAddress::class);
    }

    public function invoiceTo()
    {
        return $this->belongsTo(InvoiceTo::class);
    }
    public function internalOnlyAttachment()
    {
        return $this->hasMany(InternalOnlyAttachment::class);
    }
    public function internalOnlyNotes()
    {
        return $this->hasMany(InternalOnlyNotes::class);
    }
    public function activityLog()
    {
        return $this->hasMany(ActivityLog::class);
    }
}
