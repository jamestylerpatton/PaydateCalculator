<?php
namespace DevXyz\Challenge;

use DevXyz\Challenge\Holidays;
use DevXyz\Challenge\PaydateCalculatorInterface;
use Exception;

class PaydateCalculator implements PaydateCalculatorInterface
{
    protected $paydateModel;

    public function __construct(string $paydateModel, array $holidays = [])
    {
        $this->paydateModel = $paydateModel;
    }

    /**
     * Takes the initial paydate and generates the next $numberOfPaydates paydates
     *
     * @param string $initialPaydate
     * @param integer $numberOfPaydates
     * @return array the next paydates (from today) as strings in Y-m-d format
     */
    public function calculatePaydates(string $initialPaydate, int $numberOfPaydates): array
    {
        if (!in_array($this->paydateModel, ['MONTHLY', 'BIWEEKLY', 'WEEKLY'])) {
            throw new \Exception("Paydate model is not valid.");
        }

        if (!$this->isValidDateFormat($initialPaydate)) {
            throw new Exception("Date format is not valid.");
        }

        if ($numberOfPaydates < 1) {
            throw new Exception("Number of paydates must be defined and more than 1.");
        }

        $paydates = [];
        $date     = $initialPaydate;

        for ($i = 0; $i < $numberOfPaydates; $i++) {
			$date      = $this->getNextPaydate($date);
			$paydates[] = $date;
        }

        return $paydates;
	}

	public function getNextPaydate($date)
	{
		switch ($this->paydateModel) {
            case 'WEEKLY':
                $unit  = 'days';
                $count = 7;
                break;
            case 'BIWEEKLY':
                $unit  = 'days';
                $count = 14;
                break;
            case 'MONTHLY':
                $unit  = 'months';
                $count = 1;
                break;
		}

		$date      = strtotime($date);
		$dateAfter = strtotime('+' . $count . ' ' . $unit, $date);
		$date      = date('Y-m-d', $dateAfter);

		if ($this->isValidPaydate($date)) {
			return $date;
		} else {
			return $this->findClosestPaydate($date);
		}
	}

    public function findClosestPaydate($date)
    {
		if ($this->isWeekend($date)) {
            while (!$this->isValidPaydate($date)) {
                $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
            }
        }
        if ($this->isHoliday($date)) {
            while (!$this->isValidPaydate($date)) {
                $date = date("Y-m-d", strtotime("-1 day", strtotime($date)));
            }
        }
        return $date;
    }

    public function isValidPaydate($date)
    {
        if (!$this->isHoliday($date) && !$this->isWeekend($date)) {
            return true;
        }

        return false;
    }

    public function isHoliday($date)
    {
		$holidays = new Holidays();

		$dateParts = explode('-', $date);
		$year = $dateParts[0];

        return in_array($date, array_keys($holidays->getByYear($year)));
    }

    public function isWeekend($date)
    {
        $weekDays = date('N', strtotime($date));
        return $weekDays == 6 || $weekDays == 7;
    }

    public function isValidDateFormat($date)
    {
        $format = 'Y-m-d';
        $d      = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}
