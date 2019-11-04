<?php
namespace DevXyz\Challenge;

class Holidays
{
	function getByYear($year){
		$holidays = [
			$year.'-01-01' => 'New Year\'s Day',
			$year.'-02-02' => 'Groundhog Day',
			$year.'-02-12' => 'Lincoln\'s Birthday',
			$year.'-02-14' => 'Valentine\'s Day',
			$year.'-03-17' => 'St. Patrick\'s Day',
			$year.'-04-01' => 'April Fool\'s Day',
			$year.'-04-22' => 'Earth Day',
			$year.'-06-14' => 'Flag Day',
			$year.'-07-04' => 'Independence Day',
			$year.'-09-11' => 'Patriot Day',
			$year.'-10-16' => 'Bosses\' Day',
			$year.'-10-31' => 'Halloween',
			$year.'-11-01' => 'All Saints\' Day',
			$year.'-11-11' => 'Veterans Day',
			$year.'-12-24' => 'Christmas Eve',
			$year.'-12-25' => 'Christmas Day',
			$year.'-12-26' => 'Kwanzaa',
			$year.'-12-31' => 'New Year\'s Eve',
		];

		// Martin Luther King Jr. Day (Third Monday in January)
		$holidayDay = date("Y-m-d",strtotime($year."-01 third monday"));
		$holidays[$holidayDay] = 'Martin Luther King Jr. Day';
		// Presidents' Day (Third Monday in February)
		$holidayDay = date("Y-m-d",strtotime($year."-02 third monday"));
		$holidays[$holidayDay] = 'Presidents\' Day';
		// Mother's Day (Second Sunday in May)
		$holidayDay = date("Y-m-d",strtotime($year."-05 second sunday"));
		$holidays[$holidayDay] = 'Mother\'s Day';
		// Memorial Day (Last Monday in May)
		$holidayDay = date("Y-m-d",strtotime($year."-06-01 last monday"));
		$holidays[$holidayDay] = 'Memorial Day';
		// Father's Day (Third Sunday in June)
		$holidayDay = date("Y-m-d",strtotime($year."-06 third sunday"));
		$holidays[$holidayDay] = 'Father\'s Day';
		// Labor Day (First Monday in September)
		$holidayDay = date("Y-m-d",strtotime($year."-09 first monday"));
		$holidays[$holidayDay] = 'Labor Day';
		// Columbus Day (Second Monday in October)
		$holidayDay = date("Y-m-d",strtotime($year."-10 second monday"));
		$holidays[$holidayDay] = 'Columbus Day';
		// Thanksgiving Day (Fourth Thursday in November)
		$holidayDay = date("Y-m-d",strtotime($year."-11 fourth thursday"));
		$holidays[$holidayDay] = 'Thanksgiving Day';

		// Easter holidays
		$easterDays = easter_days($year); // # days after March 21st
		$easterDate = date("Y-m-d",strtotime("+$easterDays days",mktime(1,1,1,3,21,$year)));
		$holidays[$easterDate] = 'Easter';

		return $holidays;
	}
}
