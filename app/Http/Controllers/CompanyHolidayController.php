<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Services\Interfaces\ICompanyHolidayService;

class CompanyHolidayController extends Controller
{

    public $CompanyHolidayService;

    public function __construct(ICompanyHolidayService $companyHolidayService)
    {
        $this->CompanyHolidayService = $companyHolidayService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('companyHolidays/index', ['companyId' => $request->companyId]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $companyHoliday = $this->CompanyHolidayService->createHoliday($request);
        return response()->json([
            'holidayName' => $companyHoliday->name,
            'holidayId' => $companyHoliday->id,
            'startDate' => $companyHoliday->startDate,
            'endDate' => $companyHoliday->endDate,
            'holidays' => $companyHoliday->holidays,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($holidayid)
    {
        $holiday = $this->CompanyHolidayService->getHolidayDetails($holidayid);

        return view('companyHolidays/editHolidayForm',
            [
                'holiday' => $holiday,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $holidayId)
    {

        $holiday = $this->CompanyHolidayService->updateHoliday($request, $holidayId);

        return response()->json(
            [
                'holidayName' => $holiday->name,
                'holidayId' => $holiday->id,
                'startDate' => $holiday->startDate,
                'endDate' => $holiday->endDate,
                'holidays' => $holiday->holidays,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($holidayId, Request $request)
    {
        $this->CompanyHolidayService->deleteHoliday($holidayId);

        return $holidayId;
    }
}
