<?php

namespace App\Http\Controllers;

use function Sodium\add;
use Illuminate\Http\Request;


class HomeController extends Controller{

    protected $content;
    private $list = array();
    protected $findHotel=null;
    protected $flag;

    public function index()
    {
        $this->firstApi();
    }
    public function firstApi()//Request $request
    {


        $this->content = file_get_contents("https://api.myjson.com/bins/pq0f6 ");
        $obj=json_decode($this->content);
        foreach ($obj->{'hotels'} as $item)
        {
            array_push ($this->list,$item);
        }


//        --------------------------------------------------------
//      //  to run the sort functions
//            $this->sortByName();
//        $this->sortByPrice();


//    //    to display the output of sort operation
//        foreach ($this->list as $item)
//        {
//            echo $item->{'name'}.' - ';
//        }
//        ---------------------------------------------
//    //    to search about hotel
//                $this->searchByName('Golden');
//        $this->searchByDestination('cair');
//        $this->searchByPrice(109.8,110);
//        $this->searchByDate('1-11-2020','3-12-2020');



//    //    to display the output of search operation
//        if($this->findHotel!=null)
//        {
//            echo $this->findHotel->{'price'};
//        }
//        else
//        {
//            echo 'this hotal not found ';
//        }

//        ----------------------------------------------------------

    }
    public function searchByName($nameKey)
    {
        foreach ($this->list as $oneHotel)
        {
            if ($oneHotel->{'name'}==$nameKey)
            {
                $this->findHotel=$oneHotel;
                break;
            }
        }
    }

    public function searchByDestination($destinationKey)
    {

        foreach ($this->list as $oneHotel) {
            if ($oneHotel->{'city'} == $destinationKey) {
                $this->findHotel = $oneHotel;
                break;
            }
        }
    }
    public function searchByPrice ($priceMiniKey,$priceMaxKey)
    {
        foreach ($this->list as $oneHotel) {
            if ($priceMiniKey<=(float)$oneHotel->{'price'}&&(float)$oneHotel->{'price'}<= $priceMaxKey) {
                $this->findHotel = $oneHotel;
                break;
            }
        }
    }

    public function searchByDate ($dateMiniKey,$dateMaxKey)
    {
        $datetimeMini = date_create($dateMiniKey);
        $datetimeMax = date_create($dateMaxKey);
        foreach ($this->list as $oneHotel) {
            foreach ($oneHotel->{'availability'} as $dates)
            {
                $objectDateFrom=date_create($dates->{'from'});
                $objectDateTo=date_create($dates->{'to'});
                $interval1 = date_diff($objectDateFrom, $datetimeMini);
                if ((int)$interval1->format('%R%a days')>=0)
                {
                    $interval2 =date_diff( $datetimeMax,$objectDateTo);
                    if ((int)$interval2->format('%R%a days')>=0)
                    {
                        $this->flag=1;
                        $this->findHotel = $oneHotel;
                        break;
                    }
                }
            }
            if($this->flag==1)
            {
                break;
            }
        }
    }
    public function sortByName()
    {
        for ($counter1=0;$counter1<count($this->list)-1;$counter1++)
        {
            for ($counter=$counter1+1;$counter<count($this->list);$counter++)
            {
                if( $this->list[$counter1]->{'name'}>$this->list[$counter]->{'name'})
                {
                    $temp=$this->list[$counter];
                    $this->list[$counter]=$this->list[$counter1];
                    $this->list[$counter1]=$temp;
                }
            }
        }
    }
    public function sortByPrice()
    {

        for ($counter1=0;$counter1<count($this->list)-1;$counter1++)
        {
            for ($counter=$counter1+1;$counter<count($this->list);$counter++)
            {
                if( $this->list[$counter1]->{'price'}>$this->list[$counter]->{'price'})
                {
                    $temp=$this->list[$counter];
                    $this->list[$counter]=$this->list[$counter1];
                    $this->list[$counter1]=$temp;
                }
            }

        }

    }

    }