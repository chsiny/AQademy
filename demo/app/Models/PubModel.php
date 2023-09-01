<?php
namespace App\Models;

use CodeIgniter\Model;

class PubModel extends Model
{
    protected $table = 'TrackRecord';
    protected $userTable = 'users';
    protected $pubTable = 'Publication';

    protected $primaryKey = 'TID';
    
    public function getPub($username, $year=2023)
    {
        $builder = $this->join('users','TrackRecord.userID=users.uid')
                        ->join('Publication','TrackRecord.pubID=Publication.PID')
                          ->where('users.username',$username)
                          ->where('Publication.PYear',$year)
                          ->orderBy('Publication.PID','ASC');
        
        return $builder->get()->getResultArray();
    }

    public function getAllMyPub($username)
    {
        $builder = $this->select('TID,username, PType, Authors, PYear, PName,Location')
                        ->join('users','TrackRecord.userID=users.uid')
                        ->join('Publication','TrackRecord.pubID=Publication.PID')
                        ->where('users.username',$username)                        
                        ->orderBy('Publication.PYear','ASC');
        
        return $builder->get()->getResultArray();
        
    }
}