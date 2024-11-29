<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
  protected $table      = 'file_table';
  protected $primaryKey = 'fid';
  protected $useAutoIncrement = true;
  protected $returnType     = 'object';
  protected $allowedFields = [
    'bid',
    'userid',
    'filename',
    'regdate',
    'status',
    'memoid',
    'type'
  ];
}