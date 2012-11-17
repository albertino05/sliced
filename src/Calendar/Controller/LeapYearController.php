<?php

// src/Calendar/Controller/LeapYearController.php

namespace Calendar\Controller;

use Symfony\Component\HttpFoundation\Request;
use Calendar\Model\LeapYear;

class LeapYearController extends \Sliced\Controller
{

      public function indexAction(Request $request, $year)
      {
	  d($this->getContainer());
	  $leapyear = new LeapYear();
	  if ($leapyear->isLeapYear($year)) {
	        return 'Yep, this is a leap year!';
	  }
	  
	  return 'Nope, this is not a leap year.';
      }

}

?>
