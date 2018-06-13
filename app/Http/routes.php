<?php

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

   /**
    *--------------------------------------------------------------------------
    *	Routes for laravel login
    * -------------------------------------------------------------------------
    */
Route::group(['middleware' => 'web'], function () {
    // your routes here

        /*Route::get('/', [
        'uses' => 'Auth\AuthController@showLoginForm',
        'name' => '/'
        ]);*/

        Route::get('/home', 'HomeController@index');
        Route::get('/home/list', 'HomeController@getData');

        Route::get('/session-timed-out', function() {
            return view('session_timed_out');
        });

        /*WBS*/
            Route::get('/materialreceiving', [
                'uses' => 'WBS\WBSMaterialReceivingController@getWBSMaterialReceiving',
                'name' => 'materialreceiving'
            ]);

            Route::post('/wbsmrpostinvoicenum', [
                'uses' => 'WBS\WBSMaterialReceivingController@postInvoiceNo',
                'name' => 'wbsmrpostinvoicenum'
            ]);

            Route::get('/wbsmrcancel', [
                'uses' => 'WBS\WBSMaterialReceivingController@wbsCancel',
                'name' => 'wbsmrcancel'
            ]);

            Route::get('/wbsgetlatestmr', [
                'uses' => 'WBS\WBSMaterialReceivingController@getLatestMR',
                'name' => 'wbsgetlatestmr'
            ]);

            Route::get('/wbsnavigate', [
                'uses' => 'WBS\WBSMaterialReceivingController@getWBSNavigate',
                'name' => 'wbsnavigate'
            ]);

            Route::get('/wbsmrnumber', [
                'uses' => 'WBS\WBSMaterialReceivingController@getWBSMRnumber',
                'name' => 'wbsmrnumber'
            ]);

            Route::get('/wbsmrsearch', [
                'uses' => 'WBS\WBSMaterialReceivingController@getWBSMRsearch',
                'name' => 'wbsmrsearch'
            ]);

            Route::get('/wbsmrlookitem', [
                'uses' => 'WBS\WBSMaterialReceivingController@getWBSMRlookItem',
                'name' => 'wbsmrlookitem'
            ]);

            Route::post('/wbsmrprintbarcode', [
                'uses' => 'WBS\WBSMaterialReceivingController@printBarcode',
                'name' => 'wbsmrprintbarcode'
            ]);

            Route::get('/wbsmrupdateisprinted', [
                'uses' => 'WBS\WBSMaterialReceivingController@getUpdateIsPrintedview',
                'name' => 'wbsmrupdateisprinted'
            ]);

            Route::get('/wbsmrprintmr', [
                'uses' => 'WBS\WBSMaterialReceivingController@printMaterialReceive',
                'name' => 'wbsmrprintmr'
            ]);

            Route::get('/wbsmrprintiqc', [
                'uses' => 'WBS\WBSMaterialReceivingController@printForIQC',
                'name' => 'wbsmrprintiqc'
            ]);

            Route::post('/wbsmrdeletebatch', [
                'uses' => 'WBS\WBSMaterialReceivingController@postDeleteBatchItem',
                'name' => 'wbsmrdeletebatch'
            ]);

            Route::post('/wbsmrsave', [
                'uses' => 'WBS\WBSMaterialReceivingController@postSaveMaterialReceiving',
                'name' => 'wbsmrsave'
            ]);

            Route::get('/wbsmrgetitems', [
                'uses' => 'WBS\WBSMaterialReceivingController@getItems',
                'name' => 'wbsmrgetitems'
            ]);

            Route::get('/wbsmrgetitemdata', [
                'uses' => 'WBS\WBSMaterialReceivingController@getItemData',
                'name' => 'wbsmrgetitemdata'
            ]);

            Route::get('/wbsmrgetpackage', [
                'uses' => 'WBS\WBSMaterialReceivingController@getPackage',
                'name' => 'wbsmrgetpackage'
            ]);

            Route::get('/wbsmrsinglebatchitem', [
                'uses' => 'WBS\WBSMaterialReceivingController@getSingleBatchItem',
                'name' => 'wbsmrsinglebatchitem'
            ]);

            Route::get('/wbsmrcheckifnotforiqc', [
                'uses' => 'WBS\WBSMaterialReceivingController@notForIQC',
                'name' => 'wbsmrcheckifnotforiqc'
            ]);

            Route::post('/wbsmrcanvelinvoice', [
                'uses' => 'WBS\WBSMaterialReceivingController@postCancelMr',
                'name' => 'wbsmrcanvelinvoice'
            ]);

            Route::post('/wbsuploadbatchitems', [
                'uses' => 'WBS\WBSMaterialReceivingController@BatchItemExcel',
                'name' => 'wbsuploadbatchitems'
            ]);

            Route::post('/wbsmrreceiveall', [
                'uses' => 'WBS\WBSMaterialReceivingController@receiveAll',
                'name' => 'wbsmrreceiveall'
            ]);

            Route::get('/wbsmr-refresh', [
                'uses' => 'WBS\WBSMaterialReceivingController@refeshInvoice',
                'name' => 'wbsmr-refresh'
            ]);

        /*WBS LOCAL MATERIAL RECEIVING*/
            Route::get('/wbslocmat', [
                'uses' => 'WBS\WBSLocalMaterialReceivingController@index',
                'name' => 'wbslocmat'
            ]);

            Route::post('/wbsuploadlocmat', [
                'uses' => 'WBS\WBSLocalMaterialReceivingController@ExtractExcelFile',
                'name' => 'wbsuploadlocmat'
            ]);

            Route::post('/savelocamat', [
                'uses' => 'WBS\WBSLocalMaterialReceivingController@postSaveLocRec',
                'name' => 'savelocamat'
            ]);

            Route::get('/wbslocmatgetdata', [
                'uses' => 'WBS\WBSLocalMaterialReceivingController@getLocalMaterialData',
                'name' => 'wbslocmatgetdata'
            ]);

            Route::get('/wbsmrlocalprintiqc', [
                'uses' => 'WBS\WBSLocalMaterialReceivingController@printForIQC',
                'name' => 'wbsmrlocalprintiqc'
            ]);

            Route::get('/wbslocmatsummaryreport', [
                'uses' => 'WBS\WBSLocalMaterialReceivingController@summaryReport',
                'name' => 'wbslocmatsummaryreport'
            ]);

            Route::post('/wbslocalprintbarcode', [
                'uses' => 'WBS\WBSLocalMaterialReceivingController@printBarcode',
                'name' => 'wbslocalprintbarcode'
            ]);

            Route::post('/wbslocupdatebatchitem', [
                'uses' => 'WBS\WBSLocalMaterialReceivingController@updateBatchItem',
                'name' => 'wbslocupdatebatchitem'
            ]);

            Route::get('/wbslociqc', [
                'uses' => 'WBS\WBSLocalMaterialReceivingController@ApplicationForIQC',
                'name' => 'wbslociqc'
            ]);

            Route::get('/wbslocpackagecategory', [
                'uses' => 'WBS\WBSLocalMaterialReceivingController@getPackage',
                'name' => 'wbslocpackagecategory'
            ]);

            Route::post('/wbslocaldeletebatchitem', [
                'uses' => 'WBS\WBSLocalMaterialReceivingController@postDeleteBatchItem',
                'name' => 'wbslocaldeletebatchitem'
            ]);

            Route::get('/wbslocgettotal', [
                'uses' => 'WBS\WBSLocalMaterialReceivingController@getTotal',
                'name' => 'wbslocgettotal'
            ]);


        /*WBS IQC Inspection*/
            Route::get('/iqc', [
                'uses' => 'WBS\WBSIqcController@getWbsIqc',
                'name' => 'iqc'
            ]);

            Route::get('/getwbsiqc', [
                'uses' => 'WBS\WBSIqcController@getLoadwbs',
                'name' => 'getwbsiqc'
            ]);

            Route::get('/getwbsiqcsearch', [
                'uses' => 'WBS\WBSIqcController@getSearch',
                'name' => 'getwbsiqcsearch'
            ]);

            Route::post('/postwbsiqcsingleupdate', [
                'uses' => 'WBS\WBSIqcController@postUpdateIQCstatus',
                'name' => 'postwbsiqcsingleupdate'
            ]);

            Route::post('/postwbsiqcupdatebulk', [
                'uses' => 'WBS\WBSIqcController@postUpdateIQCstatusBulk',
                'name' => 'postwbsiqcupdatebulk'
            ]);

            // Route::get('/iqc', [
            //     'uses' => 'WBS\WBSIqcController@getWbsIqc',
            //     'name' => 'iqc'
            // ]);

            // Route::get('/getwbsiqc/{status}', [
            //     'uses' => 'WBS\WBSIqcController@getLoadwbs',
            //     'name' => 'getwbsiqc'
            // ]);

            // Route::get('/getwbsiqcsearch', [
            //     'uses' => 'WBS\WBSIqcController@getSearch',
            //     'name' => 'getwbsiqcsearch'
            // ]);

            // Route::post('/postwbsiqcsingleupdate', [
            //     'uses' => 'WBS\WBSIqcController@postUpdateIQCstatus',
            //     'name' => 'postwbsiqcsingleupdate'
            // ]);

            // Route::post('/postwbsiqcupdatebulk', [
            //     'uses' => 'WBS\WBSIqcController@postUpdateIQCstatusBulk',
            //     'name' => 'postwbsiqcupdatebulk'
            // ]);

        /*Material Kitting*/
            // Route::get('/wbsmaterialkitting', [
            //     'uses' => 'WBS\WBSMaterialKittingController@getMaterialKitting',
            //     'name' => 'wbsmaterialkitting'
            // ]);

            // Route::post('/wbsmaterialkitting', [
            //     'uses' => 'WBS\WBSMaterialKittingController@getMaterialKitting',
            //     'name' => 'wbsmaterialkitting'
            // ]);

            // Route::post('/searchpo', [
            //     'uses' => 'WBS\WBSMaterialKittingController@postSearchPO',
            //     'name' => 'searchpo'
            // ]);

            // Route::post('/searchpoprod', [
            //     'uses' => 'WBS\WBSMaterialKittingController@postSearchPOprod',
            //     'name' => 'searchpoprod'
            // ]);

            // Route::post('/getcodedetails', [
            //     'uses' => 'WBS\WBSMaterialKittingController@postCodeDetails',
            //     'name' => 'getcodedetails'
            // ]);

            // Route::post('/getlotnodetails', [
            //     'uses' => 'WBS\WBSMaterialKittingController@postLotNoDetails',
            //     'name' => 'getlotnodetails'
            // ]);

            // Route::post('/updatekitqty', [
            //     'uses' => 'WBS\WBSMaterialKittingController@postUpdateKitQty',
            //     'name' => 'updatekitqty'
            // ]);

            // Route::post('/savematkit', [
            //     'uses' => 'WBS\WBSMaterialKittingController@postSaveMatKit',
            //     'name' => 'savematkit'
            // ]);

            // Route::post('/savematissue', [
            //     'uses' => 'WBS\WBSMaterialKittingController@postSaveMatIss',
            //     'name' => 'savematissue'
            // ]);

            // Route::post('/cancelkit', [
            //     'uses' => 'WBS\WBSMaterialKittingController@postCancelMatKit',
            //     'name' => 'cancelkit'
            // ]);

            // Route::post('/wbskit-search', [
            //     'uses' => 'WBS\WBSMaterialKittingController@searchKitWbsData',
            //     'name' => 'wbskit-search'
            // ]);

            // Route::get('/wbskit-report', [
            //     'uses' => 'WBS\WBSMaterialKittingController@printMkReport',
            //     'name' => 'wbskit-report'
            // ]);

            // Route::get('/wbskit-print-report', [
            //     'uses' => 'WBS\WBSMaterialKittingController@printMkReport2',
            //     'name' => 'wbskit-print-report'
            // ]);

            // Route::get('/wbsmatkitexceldispatch', [
            //     'uses' => 'WBS\WBSMaterialKittingController@excelMkReport',
            //     'name' => 'wbsmatkitexceldispatch'
            // ]);

            // Route::post('/transfertosakidashi', [
            //     'uses' => 'WBS\WBSMaterialKittingController@postTransferToSakidashi',
            //     'name' => 'transfertosakidashi'
            // ]);

            // Route::post('/deletekitdetails', [
            //     'uses' => 'WBS\WBSMaterialKittingController@postDeleteKitDetails',
            //     'name' => 'deletekitdetails'
            // ]);

            // Route::get('/wbsmatkitfifotbl', [
            //     'uses' => 'WBS\WBSMaterialKittingController@getFifoTable',
            //     'name' => 'wbsmatkitfifotbl'
            // ]);

            // Route::get('/getbarcode', [
            //     'uses' => 'WBS\WBSMaterialKittingController@getbarcode',
            //     'name' => 'getbarcode'
            // ]);

            // Route::get('/getlotno', [
            //     'uses' => 'WBS\WBSMaterialKittingController@getlotno',
            //     'name' => 'getlotno'
            // ]);

            // Route::get('/wbskit-brprint', [
            //     'uses' => 'WBS\WBSMaterialKittingController@BrCodePrint',
            //     'name' => 'wbskit-brprint'
            // ]);

            // Route::post('/wbsmatkitfiforeason', [
            //     'uses' => 'WBS\WBSMaterialKittingController@fifoReason',
            //     'name' => 'wbsmatkitfiforeason'
            // ]);

            // Route::get('/wbsmatkitreasonexcel', [
            //     'uses' => 'WBS\WBSMaterialKittingController@fifoReasonExcel',
            //     'name' => 'wbsmatkitreasonexcel'
            // ]);
            

            Route::group(['prefix' => 'material-kitting'], function() {
                Route::get('/','WBS\WBSMaterialKittingController@index')->middleware('auth','revalidate');

                Route::get('/wbsmaterialkittingdata', [
                    'uses' => 'WBS\WBSMaterialKittingController@getMaterialKittingData',
                    'name' => 'wbsmaterialkittingdata'
                ]);

                Route::post('/searchpo', [
                    'uses' => 'WBS\WBSMaterialKittingController@postSearchPO',
                    'name' => 'searchpo'
                ]);

                Route::post('/searchpoprod', [
                    'uses' => 'WBS\WBSMaterialKittingController@postSearchPOprod',
                    'name' => 'searchpoprod'
                ]);

                Route::post('/item-lot-fifo', [
                    'uses' => 'WBS\WBSMaterialKittingController@getItemAndLotnumFifo',
                    'name' => 'item-lot-fifo'
                ]);

                Route::post('/getlotnodetails', [
                    'uses' => 'WBS\WBSMaterialKittingController@postLotNoDetails',
                    'name' => 'getlotnodetails'
                ]);

                Route::post('/updatekitqty', [
                    'uses' => 'WBS\WBSMaterialKittingController@postUpdateKitQty',
                    'name' => 'updatekitqty'
                ]);

                Route::post('/savekitdetails', [
                    'uses' => 'WBS\WBSMaterialKittingController@postSaveKitDetails',
                    'name' => 'savekitdetails'
                ]);

                // Route::post('/saveissdetails', [
                //     'uses' => 'WBS\WBSMaterialKittingController@postUpdateIssuanceDetails',
                //     'name' => 'saveissdetails'
                // ]);

                Route::get('/kitdata', [
                    'uses' => 'WBS\WBSMaterialKittingController@getKitData',
                    'name' => 'kitdata'
                ]);

                Route::post('/savematissue', [
                    'uses' => 'WBS\WBSMaterialKittingController@postSaveMatIss',
                    'name' => 'savematissue'
                ]);

                Route::post('/cancel-po', [
                    'uses' => 'WBS\WBSMaterialKittingController@postCancelMatKit',
                    'name' => 'cancel-po'
                ]);

                Route::get('/search-filter', [
                    'uses' => 'WBS\WBSMaterialKittingController@searchKitData',
                    'name' => 'search-filter'
                ]);

                Route::get('/kitting-list', [
                    'uses' => 'WBS\WBSMaterialKittingController@kittingList',
                    'name' => 'kitting-list'
                ]);

                Route::get('/transfer-slip', [
                    'uses' => 'WBS\WBSMaterialKittingController@transferSlip',
                    'name' => 'transfer-slip'
                ]);

                Route::get('/wbsmatkitexceldispatch', [
                    'uses' => 'WBS\WBSMaterialKittingController@excelMkReport',
                    'name' => 'wbsmatkitexceldispatch'
                ]);

                Route::post('/transfertosakidashi', [
                    'uses' => 'WBS\WBSMaterialKittingController@postTransferToSakidashi',
                    'name' => 'transfertosakidashi'
                ]);

                Route::post('/delete-kitdetails', [
                    'uses' => 'WBS\WBSMaterialKittingController@postDeleteKitDetails',
                    'name' => 'delete-kitdetails'
                ]);

                Route::post('/delete-issdetails', [
                    'uses' => 'WBS\WBSMaterialKittingController@postDeleteIssDetails',
                    'name' => 'delete-kitdetails'
                ]);

                Route::get('/wbsmatkitfifotbl', [
                    'uses' => 'WBS\WBSMaterialKittingController@getFifoTable',
                    'name' => 'wbsmatkitfifotbl'
                ]);

                Route::get('/getbarcode', [
                    'uses' => 'WBS\WBSMaterialKittingController@getbarcode',
                    'name' => 'getbarcode'
                ]);

                Route::get('/getlotno', [
                    'uses' => 'WBS\WBSMaterialKittingController@getlotno',
                    'name' => 'getlotno'
                ]);

                Route::get('/brprint', [
                    'uses' => 'WBS\WBSMaterialKittingController@printBarCode',
                    'name' => 'brprint'
                ]);

                Route::post('/fiforeason', [
                    'uses' => 'WBS\WBSMaterialKittingController@fifoReason',
                    'name' => 'fiforeason'
                ]);

                Route::get('/reasonlogs', [
                    'uses' => 'WBS\WBSMaterialKittingController@fifoReasonExcel',
                    'name' => 'reasonlogs'
                ]);

                Route::get('/check-issued-qty', [
                    'uses' => 'WBS\WBSMaterialKittingController@checkIssuedQty',
                    'name' => 'check-issued-qty'
                ]);
            });




        /*Prod Material Request*/
            Route::get('/wbsprodmatrequest', [
                'uses' => 'WBS\WBSProductMatReqController@getProdMatRequest',
                'name' => 'wbsprodmatrequest'
            ]);

            Route::post('/wbsprodmatrequest', [
                'uses' => 'WBS\WBSProductMatReqController@getProdMatRequest',
                'name' => 'wbsprodmatrequest'
            ]);

            Route::post('/posearch', [
                'uses' => 'WBS\WBSProductMatReqController@postSearchPO',
                'name' => 'posearch'
            ]);

            Route::post('/savedetailpmr', [
                'uses' => 'WBS\WBSProductMatReqController@postSaveDetail',
                'name' => 'savedetailpmr'
            ]);

            Route::post('/requestsummaryfrm', [
                'uses' => 'WBS\WBSProductMatReqController@postSaveRequest',
                'name' => 'requestsummaryfrm'
            ]);

            Route::post('/cancelpmr', [
                'uses' => 'WBS\WBSProductMatReqController@postCancelPmr',
                'name' => 'cancelpmr'
            ]);

            Route::post('/searchpmr', [
                'uses' => 'WBS\WBSProductMatReqController@postSearchPmr',
                'name' => 'searchpmr'
            ]);

            Route::get('/printpmr', [
                'uses' => 'WBS\WBSProductMatReqController@postPrintPmr',
                'name' => 'printpmr'
            ]);
            Route::get('/getmassalertprodreq', [
                'uses' => 'WBS\WBSProductMatReqController@getMassAlert',
                'name' => 'getmassalertprodreq'
            ]);

            Route::post('/edit-acknowledgeby', [
                'uses' => 'WBS\WBSProductMatReqController@editAcknowledgeby',
                'name' => 'edit-acknowledgeby'
            ]);

            Route::post('/checkacknowledge', [
                'uses' => 'WBS\WBSProductMatReqController@checkAcknowledge',
                'name' => 'checkacknowledge'
            ]);

        /* Sakidashi Inspection*/
            // Route::get('/wbssakidashi', [
            //     'uses' => 'WBS\WBSSakidashiController@getSakidahi',
            //     'name' => 'wbssakidashi'
            // ]);

            // Route::post('/wbssi-searchpo', [
            //     'uses' => 'WBS\WBSSakidashiController@searchPO',
            //     'name' => 'wbssi-searchpo'
            // ]);

            // Route::post('/wbssisave', [
            //     'uses' => 'WBS\WBSSakidashiController@saveRecord',
            //     'name' => 'wbssisave'
            // ]);

            // Route::get('/wbssi-getlatest', [
            //     'uses' => 'WBS\WBSSakidashiController@getLatest',
            //     'name' => 'wbssi-getlatest'
            // ]);

            // Route::get('/wbssi-gettranscode', [
            //     'uses' => 'WBS\WBSSakidashiController@getTransCode',
            //     'name' => 'wbssi-gettranscode'
            // ]);

            // Route::get('/wbssi-history', [
            //     'uses' => 'WBS\WBSSakidashiController@itemHistory',
            //     'name' => 'wbssi-history'
            // ]);

            // Route::get('/wbssi-nav', [
            //     'uses' => 'WBS\WBSSakidashiController@sakiNavigate',
            //     'name' => 'wbssi-nav'
            // ]);

            // Route::get('/wbssi-report', [
            //     'uses' => 'WBS\WBSSakidashiController@printSiReport',
            //     'name' => 'wbssi-report'
            // ]);

            // Route::post('/wbssi-cancel', [
            //     'uses' => 'WBS\WBSSakidashiController@cancelPO',
            //     'name' => 'wbssi-cancel'
            // ]);

            // Route::post('/wbssi-search', [
            //     'uses' => 'WBS\WBSSakidashiController@searchSiWbsData',
            //     'name' => 'wbssi-search'
            // ]);

            // Route::get('/sakiExportToExcel', [
            //     'uses' => 'WBS\WBSSakidashiController@sakiExportToExcel',
            //     'name' => 'sakiExportToExcel'
            // ]);

            // Route::get('/wbssi-fifo', [
            //     'uses' => 'WBS\WBSSakidashiController@getFifoTable',
            //     'name' => 'wbssi-fifo'
            // ]);

            // Route::get('/wbssi-checkinpo', [
            //     'uses' => 'WBS\WBSSakidashiController@checkInPO',
            //     'name' => 'wbssi-checkinpo'
            // ]);

            // Route::get('/wbssi-checkinfifo', [
            //     'uses' => 'WBS\WBSSakidashiController@checkInFIFO',
            //     'name' => 'wbssi-checkinfifo'
            // ]);

            // Route::get('/wbssaki-brprint', [
            //     'uses' => 'WBS\WBSSakidashiController@BrCodePrint',
            //     'name' => 'wbssaki-brprint'
            // ]);

            // Route::post('/wbssakififoreason', [
            //     'uses' => 'WBS\WBSMaterialKittingController@fifoReason',
            //     'name' => 'wbssakififoreason'
            // ]);

            // Route::get('/wbssakireasonexcel', [
            //     'uses' => 'WBS\WBSMaterialKittingController@fifoReasonExcel',
            //     'name' => 'wbssakireasonexcel'
            // ]);
            
            Route::group(['prefix' => 'sakidashi-issuance'], function() {
                Route::get('/', 'WBS\WBSSakidashiIssuanceController@index')->middleware('auth','revalidate');

                Route::post('/searchpo', [
                    'uses' => 'WBS\WBSSakidashiIssuanceController@searchPO',
                    'name' => 'searchpo'
                ]);

                Route::post('/wbssisave', [
                    'uses' => 'WBS\WBSSakidashiIssuanceController@saveRecord',
                    'name' => 'wbssisave'
                ]);

                Route::get('/get-latest', [
                    'uses' => 'WBS\WBSSakidashiIssuanceController@getLatest',
                    'name' => 'get-latest'
                ]);

                Route::get('/get-sakidashi-data', [
                    'uses' => 'WBS\WBSSakidashiIssuanceController@getSakisahiData',
                    'name' => 'get-sakidashi-data'
                ]);

                Route::get('/get-transcode', [
                    'uses' => 'WBS\WBSSakidashiIssuanceController@getTransCode',
                    'name' => 'get-transcode'
                ]);

                Route::get('/get-history', [
                    'uses' => 'WBS\WBSSakidashiIssuanceController@itemHistory',
                    'name' => 'get-history'
                ]);

                Route::get('/navigate', [
                    'uses' => 'WBS\WBSSakidashiIssuanceController@sakiNavigate',
                    'name' => 'navigate'
                ]);

                Route::get('/issuance-sheet', [
                    'uses' => 'WBS\WBSSakidashiIssuanceController@printSiReport',
                    'name' => 'issuance-sheet'
                ]);

                Route::post('/cancel-po', [
                    'uses' => 'WBS\WBSSakidashiIssuanceController@cancelPO',
                    'name' => 'cancel-po'
                ]);

                Route::post('/search', [
                    'uses' => 'WBS\WBSSakidashiIssuanceController@searchSiWbsData',
                    'name' => 'search'
                ]);

                Route::get('/export-to-excel', [
                    'uses' => 'WBS\WBSSakidashiIssuanceController@sakiExportToExcel',
                    'name' => 'export-to-excel'
                ]);

                Route::get('/fifo', [
                    'uses' => 'WBS\WBSSakidashiIssuanceController@getFifoTable',
                    'name' => 'fifo'
                ]);

                Route::get('/checkinpo', [
                    'uses' => 'WBS\WBSSakidashiIssuanceController@checkInPO',
                    'name' => 'checkinpo'
                ]);

                Route::get('/checkinfifo', [
                    'uses' => 'WBS\WBSSakidashiIssuanceController@checkInFIFO',
                    'name' => 'checkinfifo'
                ]);

                Route::get('/print-barcode', [
                    'uses' => 'WBS\WBSSakidashiIssuanceController@BrCodePrint',
                    'name' => 'print-barcode'
                ]);
            });

        /* Material Issuance*/
            Route::get('/wbswhsmatissuance', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@getWarehouse',
                'name' => 'wbswhsmatissuance'
            ]);

            Route::post('/wbswhsmatissuance', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@getWarehouse',
                'name' => 'wbswhsmatissuance'
            ]);
            Route::get('/getmassalert', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@getMassAlert',
                'name' => 'getmassalert'
            ]);

            Route::post('/viewdetails', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@viewDetails',
                'name' => 'viewdetails'
            ]);

            Route::post('/wbswmi-save', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@postSaveRequest',
                'name' => 'wbswmi-save'
            ]);

            Route::post('/wbswmi-update', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@postSaveRequest',
                'name' => 'wbswmi-save'
            ]);

            Route::post('/wbswmi-cancel', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@postCancelRequest',
                'name' => 'wbswmi-cancel'
            ]);

            Route::post('/wbswmi-search', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@postSearchRequest',
                'name' => 'wbswmi-search'
            ]);

            Route::get('/wbswmi-report', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@getPrintRequest',
                'name' => 'wbswmi-report'
            ]);

            //* latest routes*//
            Route::post('/savewhsissuance', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@postSaveIssuance',
                'name' => 'savewhsissuance'
            ]);

            Route::get('/whsissuancenav', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@getWBSMKLNavigate',
                'name' => 'whsissuancenav'
            ]);

            Route::get('/whslatestissuance', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@getLatest',
                'name' => 'whslatestissuance'
            ]);

            Route::post('/whsissuancecancel', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@postCancelIssuance',
                'name' => 'whsissuancecancel'
            ]);

            Route::get('/wbswhsissuancefifotbl', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@getFifoTable',
                'name' => 'wbswhsissuancefifotbl'
            ]);
            Route::get('/wbswhsissuancefifotblbc', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@getFifoTablebc',
                'name' => 'wbswhsissuancefifotblbc'
            ]);

            Route::get('/wbswhscheckifnotclose', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@getIfNotClose',
                'name' => 'wbswhscheckifnotclose'
            ]);

            Route::get('/wbswhsserving', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@getWhsServing',
                'name' => 'wbswhsserving'
            ]);
            Route::get('/wbsWhsReport_Excel', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@wbsWhsReport_Excel',
                'name' => 'wbsWhsReport_Excel'
            ]);
            Route::get('/gettotalbalanceqty', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@getBalance',
                'name' => 'gettotalbalanceqty'
            ]);
            Route::get('/getsearch_viewDetails', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@getsearch_viewDetails',
                'name' => 'getsearch_viewDetails'
            ]);
            Route::get('/getmatbarcode', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@getmatbarcode',
                'name' => 'getmatbarcode'
            ]);
            Route::get('/getmatlotno', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@getmatlotno',
                'name' => 'getmatlotno'
            ]);
            Route::get('/whs-material-request-pdf', [
                'uses' => 'WBS\WBSWhsMatIssueanceController@materialRequestPDF',
                'name' => 'whs-material-request-pdf'
            ]);

            // Route::get('/whscheckrequest', [
            //     'uses' => 'WBS\WBSWhsMatIssueanceController@checkRequest',
            //     'name' => 'whscheckrequest'
            // ]);

        /* Physical Inventory*/
            Route::get('/wbsphysicalinventory', [
                'uses' => 'WBS\WBSPhysicalInventoryController@getPhysicalInventory',
                'name' => 'wbsphysicalinventory'
            ]);

            Route::post('/wbsphysicalinventory', [
                'uses' => 'WBS\WBSPhysicalInventoryController@getPhysicalInventory',
                'name' => 'wbsphysicalinventory'
            ]);

            Route::post('/wbspi-cancel', [
                'uses' => 'WBS\WBSPhysicalInventoryController@cancelPiWbs',
                'name' => 'wbspi-cancel'
            ]);

            Route::post('/wbspi-save', [
                'uses' => 'WBS\WBSPhysicalInventoryController@savePiWbs',
                'name' => 'wbspi-save'
            ]);

            Route::post('/wbspi-update', [
                'uses' => 'WBS\WBSPhysicalInventoryController@updatePiWbs',
                'name' => 'wbspi-update'
            ]);

            Route::post('/wbspi-search', [
                'uses' => 'WBS\WBSPhysicalInventoryController@searchPiWbsData',
                'name' => 'wbspi-search'
            ]);

            Route::get('/wbspi-report', [
                'uses' => 'WBS\WBSPhysicalInventoryController@printPiReport',
                'name' => 'wbspi-report'
            ]);
            Route::get('/wbsPiReport_Excel', [
                'uses' => 'WBS\WBSPhysicalInventoryController@wbsPiReport_Excel',
                'name' => 'wbsPiReport_Excel'
            ]);

            Route::get('/wbsphygetbrdetails', [
                'uses' => 'WBS\WBSPhysicalInventoryController@getBRdetails',
                'name' => 'wbsphygetbrdetails'
            ]);

        /* Parts Receiving*/

            Route::get('/wbspartsreceiving', [
                'uses' => 'WBS\WBSPartsReceivingController@getWBSPartsReceiving',
                'name' => 'wbspartsreceiving'
            ]);

            Route::post('/wbspartsreceiving', [
                'uses' => 'WBS\WBSPartsReceivingController@getWBSPartsReceiving',
                'name' => 'wbspartsreceiving'
            ]);

            /* Route::post('/updateTabs', [
                'uses' => 'WBS\WBSPartsReceivingController@postUpdateTabs',
                'name' => 'updateTabs'
            ]);*/

            Route::post('/wbspat-invoice', [
                'uses' => 'WBS\WBSPartsReceivingController@postLoadInvoice',
                'name' => 'wbspat-invoice'
            ]);

            Route::post('/wbspat-save', [
                'uses' => 'WBS\WBSPartsReceivingController@savePrWbs',
                'name' => 'wbspat-save'
            ]);

            Route::post('/wbspat-update', [
                'uses' => 'WBS\WBSPartsReceivingController@updatePrWbs',
                'name' => 'wbspat-update'
            ]);

            Route::post('/wbspat-cancel', [
                'uses' => 'WBS\WBSPartsReceivingController@cancelPrWbs',
                'name' => 'wbspat-cancel'
            ]);

            Route::post('/wbspat-search', [
                'uses' => 'WBS\WBSPartsReceivingController@searchPrWbsData',
                'name' => 'wbspat-search'
            ]);

            Route::post('/wbspat-barcode', [
                'uses' => 'WBS\WBSPartsReceivingController@printMrBarcode',
                'name' => 'wbspat-barcode'
            ]);

            Route::get('/wbspat-report', [
                'uses' => 'WBS\WBSPartsReceivingController@printMrReport',
                'name' => 'wbspat-report'
            ]);

        /* Material Disposistion */
            Route::get('/wbsmaterialdisposition', [
                'uses' => 'WBS\WBSMaterialDispositionController@getMatDisposistion',
                'name' => 'wbsmaterialdisposition'
            ]);
            Route::post('/dispositionsave', [
                'uses' => 'WBS\WBSMaterialDispositionController@dispositionsave',
                'name' => 'dispositionsave'
            ]);
            Route::get('/wbsdispositiongetrows', [
                'uses' => 'WBS\WBSMaterialDispositionController@wbsdispositiongetrows',
                'name' => 'wbsdispositiongetrows'
            ]);
            Route::post('/deleteDisposition', [
                'uses' => 'WBS\WBSMaterialDispositionController@deleteDisposition',
                'name' => 'deleteDisposition'
            ]);
            Route::get('/dispositionExportToExcel', [
                'uses' => 'WBS\WBSMaterialDispositionController@dispositionExportToExcel',
                'name' => 'dispositionExportToExcel'
            ]);
            Route::get('/itemcodechange', [
                'uses' => 'WBS\WBSMaterialDispositionController@itemcodechange',
                'name' => 'itemcodechange'
            ]);

        /*Production Material Return*/
            Route::get('/wbsprodmatreturn', [
                'uses' => 'WBS\WBSProdMatReturnController@getProdMatReturn',
                'name' => 'wbsprodmatreturn'
            ]);

            Route::get('/get-material-return-data', [
                'uses' => 'WBS\WBSProdMatReturnController@getData',
                'name' => 'get-material-return-data'
            ]);

            Route::post('/save-material-return', [
                'uses' => 'WBS\WBSProdMatReturnController@postSaveMatReturn',
                'name' => 'save-material-return'
            ]);

            Route::get('/get-issuanceno', [
                'uses' => 'WBS\WBSProdMatReturnController@getIssuanceno',
                'name' => 'get-issuanceno'
            ]);

            Route::get('/get-item-details', [
                'uses' => 'WBS\WBSProdMatReturnController@getItemDetails',
                'name' => 'get-item-details'
            ]);

            Route::get('/wbsreturn-brprint', [
                'uses' => 'WBS\WBSProdMatReturnController@BrCodePrint',
                'name' => 'wbsreturn-brprint'
            ]);

            Route::post('/delete-item-return', [
                'uses' => 'WBS\WBSProdMatReturnController@deleteItem',
                'name' => 'delete-item-return'
            ]);

            
            

        /* WBS Report */
            Route::get('/wbsreports', [
                'uses' => 'WBS\WBSReportController@getWBSReport',
                'name' => 'wbsreports'
            ]);

            Route::get('/wbsreportmklreport', [
                'uses' => 'WBS\WBSReportController@getWBSMatKit',
                'name' => 'wbsreportmklreport'
            ]);

            Route::get('/wbsreportsakireport', [
                'uses' => 'WBS\WBSReportController@getWBSSakidashi',
                'name' => 'wbsreportmklreport'
            ]);
            Route::get('/wbsreportphyreport', [
                'uses' => 'WBS\WBSReportController@wbsreportphyreport',
                'name' => 'wbsreportphyreport'
            ]);
            Route::get('/wbsreportwmireport', [
                'uses' => 'WBS\WBSReportController@wbsreportwmireport',
                'name' => 'wbsreportwmireport'
            ]);
            Route::get('/wbsreportpmrreport', [
                'uses' => 'WBS\WBSReportController@wbsreportpmrreport',
                'name' => 'wbsreportpmrreport'
            ]);

        /*WBS Email Notification Settings*/
            Route::get('/wbsemailsettings', [
                'uses' => 'WBS\WBSEmailSettingsController@getEmailSettings',
                'name' => 'wbsemailsettings'
            ]);

            Route::get('/wbsemaildata', [
                'uses' => 'WBS\WBSEmailSettingsController@LoadData',
                'name' => 'wbsemaildata'
            ]);

            Route::post('/wbssaveemailsettings', [
                'uses' => 'WBS\WBSEmailSettingsController@saveEmailSettings',
                'name' => 'wbssaveemailsettings'
            ]);

            Route::post('/wbsdemaildelete', [
                'uses' => 'WBS\WBSEmailSettingsController@deleteEmail',
                'name' => 'wbsdemaildelete'
            ]);




});

    /**
     *-------------------------------------------------------------------------
     *  Routes Security
     * ------------------------------------------------------------------------
     */

        /*Change Password*/
            Route::get('/changepassword', [
                'uses' => 'Security\ChangePasswordController@getChangePassword',
                'name' => 'changepassword'
            ]);

            Route::post('/changepasswordnow', [
                'uses' => 'Security\ChangePasswordController@postChangePass',
                'name' => 'changepasswordnow'
            ]);

        /*USER GROUP*/
            Route::get('/usergroup', [
                'uses' => 'Security\UserGroupController@getUserGroup',
                'name' => 'usergroup'
            ]);

            Route::post('/add-group' ,[
                'uses' => 'Security\UserGroupController@postAddDescription',
                'name' => 'add-group'
            ]);

            Route::post('/update-group' ,[
                'uses' => 'Security\UserGroupController@updatePost',
                'name' => 'update-group'
            ]);

            Route::get('/deleteAll-group' ,[
                'uses' => 'Security\UserGroupController@deleteAllPost',
                'name' => 'deleteAll-group'
            ]);

            Route::post('/search-group' ,[
                'uses' => 'Security\UserGroupController@searchPost',
                'name' => 'search-setting'
            ]);

        /*WBS SETTING*/
            Route::get('/wbssetiing', [
                'uses' => 'Security\WBSSettingController@getWBSSetting',
                'name' => 'wbssetiing'
            ]);

            Route::post('/add-setting', [
                'uses' => 'Security\WBSSettingController@postAddDescription',
                'name' => 'add-setting'
            ]);

            Route::post('/update-setting', [
                'uses' => 'Security\WBSSettingController@updatePost',
                'name' => 'update-setting'
            ]);

            Route::get('/deleteAll-setting' ,[
                'uses' => 'Security\WBSSettingController@deleteAllPost',
                'name' => 'deleteAll-setting'
            ]);

            Route::post('/search-setting' ,[
                'uses' => 'Security\WBSSettingController@searchPost',
                'name' => 'search-setting'
            ]);

        /*Packing List SETTING*/
            Route::get('/plsetting', [
                'uses' => 'Security\PackingListSettingController@getPackListSetting',
                'name' => 'plsetting'
            ]);

            Route::post('/save-plsetting', [
                'uses' => 'Security\PackingListSettingController@postSave',
                'name' => 'save-plsetting'
            ]);

            Route::post('/delete-plsetting', [
                'uses' => 'Security\PackingListSettingController@postDelete',
                'name' => 'delete-plsetting'
            ]);

        /*TRANSACTION SETTING*/
            Route::get('/transactionsetting', [
                'uses' => 'Security\TransactionController@getTransetting',
                'name' => 'transactionsetting'
            ]);

            Route::post('/add-transaction', [
                'uses' => 'Security\TransactionController@postAddDescription',
                'name' => 'add-transaction'
            ]);

            Route::post('/update-transaction', [
                'uses' => 'Security\TransactionController@updatePost',
                'name' => 'update-transaction'
            ]);

            Route::get('/deleteAll-transaction' ,[
                'uses' => 'Security\TransactionController@deleteAllPost',
                'name' => 'deleteAll-transaction'
            ]);

            Route::post('/search-transaction' ,[
                'uses' => 'Security\TransactionController@searchPost',
                'name' => 'search-setting'
            ]);

        /*PACKINGLIST*/
            Route::get('/packinglist', [
                'uses' => 'Security\PackingListController@getPackingList',
                'name' => 'packinglist'
            ]);

            Route::post('/add-packinglist', [
                'uses' => 'Security\PackingListController@addPackingList',
                'name' => 'add-packinglist'
            ]);

            Route::post('/update-packinglist', [
                'uses' => 'Security\PackingListController@updatePackingList',
                'name' => 'update-packinglist'
            ]);
             Route::get('/deleteAll-packinglist' ,[
                'uses' => 'Security\PackingListController@deleteAllPackingList',
                'name' => 'deleteAll-packinglist'
            ]);

        /*COMPANY SETTING*/
            Route::get('/companysetting', [
                'uses' => 'Security\CompanyController@getComSetting',
                'name' => 'companysetting'
            ]);

            Route::post('/update-companysetting', [
                'uses' => 'Security\CompanyController@updatePost',
                'name' => 'update-companysetting'
            ]);




    /**
     *-------------------------------------------------------------------------
     *	Routes for Phase 2
     * ------------------------------------------------------------------------
     */
        /*PR CHANGE*/
            Route::get('/prchange', [
                'uses' => 'Phase2\PRChangeController@getPRChange',
                'name' => 'prchange'
            ]);

            Route::post('/uploadOrigPR', [
                'uses' => 'Phase2\PRChangeController@postOrigPR',
                'name' => 'uploadOrigPR'
            ]);

            Route::post('/uploadChangePR', [
                'uses' => 'Phase2\PRChangeController@postChangePR',
                'name' => 'uploadChangePR'
            ]);

            Route::get('/download-pr-output', [
                'uses' => 'Phase2\PRChangeController@PR_output',
                'name' => 'download-pr-output'
            ]);

        /*PR BALANCE*/
            Route::get('/prbalance', [
                'uses' => 'Phase2\PRBalanceController@getPRBalance',
                'name' => 'prbalance'
            ]);

            Route::post('/prbfiles', [
                'uses' => 'Phase2\PRBalanceController@postFiles',
                'name' => 'prbfiles'
            ]);

            Route::get('/prbexcel', [
                'uses' => 'Phase2\PRBalanceController@OutputFile',
                'name' => 'prbexcel'
            ]);

        /*YPICS INVENTORY QUERY*/
            Route::get('/inventoryquery', [
                'uses' => 'Phase2\InventoryQueryController@getInventoryQuery',
                'name' => 'inventoryquery'
            ]);

            Route::get('/inventoryquerybyparts', [
                'uses' => 'Phase2\ByPartsController@getByParts',
                'name' => 'inventoryquerybyparts'
            ]);

            Route::get('/bypartsearchitem', [
                'uses' => 'Phase2\ByPartsController@postByPartshowItem',
                'name' => 'bypartsearchitem'
            ]);

            Route::get('/bypartsitems', [
                'uses' => 'Phase2\ByPartsController@getByPartsItems',
                'name' => 'bypartsitems'
            ]);

            Route::get('/inventoryquerybybom', [
                'uses' => 'Phase2\ByBOMController@getByBOM',
                'name' => 'inventoryquerybybom'
            ]);

            Route::get('/bybomsearchitems', [
                'uses' => 'Phase2\ByBOMController@getByBOMshowProdItems',
                'name' => 'bybomsearchitems'
            ]);

            Route::get('/bybomitems', [
                'uses' => 'Phase2\ByBOMController@byBOMdetails',
                'name' => 'bybomitems'
            ]);

            Route::get('/inventoryqueryrebom', [
                'uses' => 'Phase2\ReBOMController@getReBOM',
                'name' => 'inventoryqueryrebom'
            ]);

            Route::get('/rebomitems', [
                'uses' => 'Phase2\ReBOMController@postReBOMItems',
                'name' => 'rebomitems'
            ]);

            Route::post('/rebomsearchBOM', [
                'uses' => 'Phase2\ReBOMController@reBOMdetails',
                'name' => 'rebomsearchBOM'
            ]);

            Route::post('/rebomsearchprod', [
                'uses' => 'Phase2\ReBOMController@reBOMgetProduct',
                'name' => 'rebomsearchprod'
            ]);

            Route::post('/updatestock', [
                'uses' => 'Phase2\InventoryQueryController@postUpdatebtn',
                'name' => 'updatestock'
            ]);

            Route::get('/stockqueryxls', [
                'uses' => 'Phase2\InventoryQueryController@getStockQueryExcel',
                'name' => 'stockqueryxls'
            ]);

        /*PACKING LIST SYSTEM*/
            Route::get('/packinglistsystem', [
                'uses' => 'Phase2\PackingListSystemController@getPackingListSystem',
                'name' => 'packinglistsystem'
            ]);

            Route::get('/packinglistsystemtable', [
                'uses' => 'Phase2\PackingListSystemController@getPackingListDatable',
                'name' => 'packinglistsystemtable'
            ]);

            Route::post('/packinglistsystem-save', [
                'uses' => 'Phase2\PackingListSystemController@savePackingList',
                'name' => 'packinglistsystem-save'
            ]);

            Route::post('/packinglistsystem-delete', [
                'uses' => 'Phase2\PackingListSystemController@deletePackingList',
                'name' => 'packinglistsystem-delete'
            ]);

            Route::get('/packinglistdetails', [
                'uses' => 'Phase2\PackingListSystemController@getPackingListDetails',
                'name' => 'packinglistdetails'
            ]);

            Route::post('/packinglistdetails', [
                'uses' => 'Phase2\PackingListSystemController@getPackingListDetails',
                'name' => 'packinglistdetails'
            ]);

            Route::post('/packinglistdetails-search', [
                'uses' => 'Phase2\PackingListSystemController@getPorders',
                'name' => 'packinglistdetails-search'
            ]);

            Route::post('/packinglistsystem-exportxls', [
                'uses' => 'Phase2\PackingListSystemController@exportListToXls',
                'name' => 'packinglistsystem-exportxls'
            ]);

            Route::post('/packinglistsystem-exportpdf', [
                'uses' => 'Phase2\PackingListSystemController@exportListToPdf',
                'name' => 'packinglistsystem-exportpdf'
            ]);

            Route::post('/packinglistsystem-printpdf', [
                'uses' => 'Phase2\PackingListSystemController@exportListToPdfPrint',
                'name' => 'packinglistsystem-printpdf'
            ]);

        /*PACKING LIST MOLDING*/
            Route::get('/packinglistmolding', [
                'uses' => 'PackingListMoldingController@getPackingListMolding',
                'name' => 'packinglistmolding'
            ]);


        /*DESTINATION & CLASSIFICATION*/
            Route::get('/test', [
                'uses' => 'DestinationController@test',
                'name' => 'test'
            ]);

            Route::get('/destination', [
                'uses' => 'DestinationController@getDestination',
                'name' => 'destination'
            ]);


            Route::get('/get_prod_destination', [
                'uses' => 'DestinationController@display_prod_description',
                'name' => 'destination'
            ]);
            Route::get('/get_line_destination', [
                'uses' => 'DestinationController@display_line_description',
                'name' => 'get_line_destination'
            ]);

            Route::post('/add-description' ,[
                'uses' => 'DestinationController@postAddDescription',
                'name' => 'add-description'
            ]);

          /*  Route::get('/delete-post' ,[
                'uses' => 'DestinationController@deletePost',
                'name' => 'delete-post'
            ]);*/

            Route::get('/display-post' ,[
                'uses' => 'DestinationController@displayPost',
                'name' => 'display-post'
            ]);

            Route::get('/deleteAll-post' ,[
                'uses' => 'DestinationController@deleteAllPost',
                'name' => 'deleteAll-post'
            ]);
            Route::post('/update-post' ,[
                'uses' => 'DestinationController@updatePost',
                'name' => 'update-post'
            ]);
            Route::post('/search-post' ,[
                'uses' => 'DestinationController@searchPost',
                'name' => 'search-post'
            ]);



    /**
     *-------------------------------------------------------------------------
     *  Routes for Phase 3
     * ------------------------------------------------------------------------
     */

        /* IQC Inspection */
            Route::get('/iqcinspection', [
                'uses' => 'QCDB\IQCInspectionController@getIQCInspection',
                'name' => 'iqcinspection'
            ]);

            Route::get('/iqcdbgetitems', [
                'uses' => 'QCDB\IQCInspectionController@getInvoiceItems',
                'name' => 'iqcdbgetitems'
            ]);

            Route::get('/iqcdbgetitemdetails', [
                'uses' => 'QCDB\IQCInspectionController@getInvoiceItemDetails',
                'name' => 'iqcdbgetitemdetails'
            ]);

            Route::get('/iqccalculatelotqty', [
                'uses' => 'QCDB\IQCInspectionController@calculateLotQty',
                'name' => 'iqccalculatelotqty'
            ]);

            Route::get('/iqcgetdropdowns', [
                'uses' => 'QCDB\IQCInspectionController@getDropdowns',
                'name' => 'iqcgetdropdowns'
            ]);

            Route::get('/iqcsamplingplan', [
                'uses' => 'QCDB\IQCInspectionController@SamplingPlan',
                'name' => 'iqcsamplingplan'
            ]);

            Route::get('/iqcshift', [
                'uses' => 'QCDB\IQCInspectionController@getShift',
                'name' => 'iqcshift'
            ]);

            Route::post('/iqcsaveinspection', [
                'uses' => 'QCDB\IQCInspectionController@saveInspection',
                'name' => 'iqcsaveinspection'
            ]);

            Route::post('/iqcdbsavemodeofdefects', [
                'uses' => 'QCDB\IQCInspectionController@saveModeOfDefectsInspection',
                'name' => 'iqcdbsavemodeofdefects'
            ]);

            Route::get('/iqcdbgetmodeofdefectsinspection', [
                'uses' => 'QCDB\IQCInspectionController@getModeOfDefectsInspection',
                'name' => 'iqcdbgetmodeofdefectsinspection'
            ]);

            Route::post('/iqcdbdeletemodeofdefects', [
                'uses' => 'QCDB\IQCInspectionController@deleteModeOfDefectsInspection',
                'name' => 'iqcdbdeletemodeofdefects'
            ]);

            Route::post('/iqcdbdeleteongoing', [
                'uses' => 'QCDB\IQCInspectionController@deleteOnGoing',
                'name' => 'iqcdbdeleteongoing'
            ]);

            Route::get('/iqcdbgetiqcdata', [
                'uses' => 'QCDB\IQCInspectionController@getIQCData',
                'name' => 'iqcdbgetiqcdata'
            ]);

            Route::get('/iqcdbgetongoing', [
                'uses' => 'QCDB\IQCInspectionController@getOngoing',
                'name' => 'iqcdbgetongoing'
            ]);

            Route::post('/iqcdbdeleteinspection', [
                'uses' => 'QCDB\IQCInspectionController@deleteIQCInspection',
                'name' => 'iqcdbdeleteinspection'
            ]);

            Route::get('/iqcdbgetitemsearch', [
                'uses' => 'QCDB\IQCInspectionController@getItemsSearch',
                'name' => 'iqcdbgetitemsearch'
            ]);

            Route::get('/iqcdbsearchinspection', [
                'uses' => 'QCDB\IQCInspectionController@searchInspection',
                'name' => 'iqcdbsearchinspection'
            ]);

            Route::get('/iqcdbgetitemrequali', [
                'uses' => 'QCDB\IQCInspectionController@getItemsRequalification',
                'name' => 'iqcdbgetitemrequali'
            ]);

            Route::get('/iqcdbgetappnorequali', [
                'uses' => 'QCDB\IQCInspectionController@getAppNoRequalification',
                'name' => 'iqcdbgetappnorequali'
            ]);

            Route::get('/iqcdbgetdetailsrequali', [
                'uses' => 'QCDB\IQCInspectionController@getDetailsRequalification',
                'name' => 'iqcdbgetdetailsrequali'
            ]);

            Route::get('/iqccalculatelotqtyrequali', [
                'uses' => 'QCDB\IQCInspectionController@calculateLotQtyRequalification',
                'name' => 'iqccalculatelotqtyrequali'
            ]);

            Route::get('/iqcdbvisualinspectionrequali', [
                'uses' => 'QCDB\IQCInspectionController@visualInspectionRequalification',
                'name' => 'iqcdbvisualinspectionrequali'
            ]);

            Route::get('/iqcgetdropdownsrequali', [
                'uses' => 'QCDB\IQCInspectionController@getDropdowns',
                'name' => 'iqcgetdropdownsrequali'
            ]);

            Route::post('/iqcsaverequali', [
                'uses' => 'QCDB\IQCInspectionController@saveRequalification',
                'name' => 'iqcsaverequali'
            ]);

            Route::get('/iqcdbgetrequalidata', [
                'uses' => 'QCDB\IQCInspectionController@getRequaliData',
                'name' => 'iqcdbgetrequalidata'
            ]);

            Route::post('/iqcdbdeleterequali', [
                'uses' => 'QCDB\IQCInspectionController@deleteRequalification',
                'name' => 'iqcdbdeleterequali'
            ]);

            Route::get('/iqcdbgetmodeofdefectsrequali', [
                'uses' => 'QCDB\IQCInspectionController@getmodeOfDefectsRequaliData',
                'name' => 'iqcdbgetmodeofdefectsrequali'
            ]);

            Route::post('/iqcdbsavemodeofdefectsrq', [
                'uses' => 'QCDB\IQCInspectionController@saveModRequalification',
                'name' => 'iqcdbsavemodeofdefectsrq'
            ]);

            Route::post('/iqcdbdeletemodeofdefectsrequali', [
                'uses' => 'QCDB\IQCInspectionController@deleteModRequalification',
                'name' => 'iqcdbdeletemodeofdefectsrequali'
            ]);

            Route::get('/iqcdbgroupbygetcontent', [
                'uses' => 'QCDB\IQCInspectionController@getGroupbyContent',
                'name' => 'iqcdbgroupbygetcontent'
            ]);

            Route::get('/iqcdbgroupbytable', [
                'uses' => 'QCDB\IQCInspectionController@getGroupByTable',
                'name' => 'iqcdbgroupbytable'
            ]);

            Route::get('/iqcdbinspectionbydate', [
                'uses' => 'QCDB\IQCInspectionController@getInspectionByDate',
                'name' => 'iqcdbinspectionbydate'
            ]);

            Route::get('/iqcprintreport', [
                'uses' => 'QCDB\IQCInspectionController@getIQCreport',
                'name' => 'iqcprintreport'
            ]);

            Route::get('/iqcprintreportexcel', [
                'uses' => 'QCDB\IQCInspectionController@getIQCreportexcel',
                'name' => 'iqcprintreportexcel'
            ]);

            Route::get('/iqcdbgethistory', [
                'uses' => 'QCDB\IQCInspectionController@searchHistory',
                'name' => 'iqcdbgethistory'
            ]);

            Route::post('/upload-iqc', [
                'uses' => 'QCDB\IQCInspectionController@uploadfiles',
                'name' => 'upload-iqc'
            ]);

            Route::get('/iqcgetworkweek', [
                'uses' => 'QCDB\IQCInspectionController@getWorkWeek',
                'name' => 'iqcgetworkweek'
            ]);

            Route::get('/iqc-get-shift', [
                'uses' => 'QCDB\IQCInspectionController@getShift',
                'name' => 'iqc-get-shift'
            ]);

            Route::post('/iqc-calculate-dppm', [
                'uses' => 'QCDB\IQCGroupByController@CalculateDPPM',
                'name' => 'iqc-calculate-dppm'
            ]);

            Route::get('/iqc-groupby-values', [
                'uses' => 'QCDB\IQCGroupByController@GroupByValues',
                'name' => 'iqc-groupby-values'
            ]);

            Route::get('/iqc-num-of-defects', [
                'uses' => 'QCDB\IQCInspectionController@getNumOfDefectives',
                'name' => 'iqc-num-of-defects'
            ]);




            // Route::get('/iqcinspectiondata', [
            //     'uses' => 'QCDB\IQCInspectionController@getIQCInspectionData',
            //     'name' => 'iqcinspectiondata'
            // ]);
            //
            // Route::get('/iqcprintreport', [
            //     'uses' => 'QCDB\IQCInspectionController@getIQCreport',
            //     'name' => 'iqcprintreport'
            // ]);
            // Route::get('/iqcprintreportexcel', [
            //     'uses' => 'QCDB\IQCInspectionController@getIQCreportexcel',
            //     'name' => 'iqcprintreportexcel'
            // ]);
            //
            // Route::get('/getinvoicedetails', [
            //     'uses' => 'QCDB\IQCInspectionController@getInvoiceDetails',
            //     'name' => 'getinvoicedetails'
            // ]);
            // Route::get('/editinspectiongetpartcode', [
            //     'uses' => 'QCDB\IQCInspectionController@editinspectiongetpartcode',
            //     'name' => 'editinspectiongetpartcode'
            // ]);
            // Route::get('/getpartcode', [
            //     'uses' => 'QCDB\IQCInspectionController@getpartcode',
            //     'name' => 'getpartcode'
            // ]);
            // Route::get('/getpartcodeLOTSUM', [
            //     'uses' => 'QCDB\IQCInspectionController@getpartcodeLOTSUM',
            //     'name' => 'getpartcodeLOTSUM'
            // ]);
            // Route::get('/getpartcode_rqLOTSUM', [
            //     'uses' => 'QCDB\IQCInspectionController@getpartcode_rqLOTSUM',
            //     'name' => 'getpartcode_rqLOTSUM'
            // ]);
            // Route::get('/getpartcode_rq', [
            //     'uses' => 'QCDB\IQCInspectionController@getpartcode_rq',
            //     'name' => 'getpartcode_rq'
            // ]);
            // Route::post('/iqcdbsave', [
            //     'uses' => 'QCDB\IQCInspectionController@iqcdbsave',
            //     'name' => 'iqcdbsave'
            // ]);
            // Route::get('/iqcdbdelete', [
            //     'uses' => 'QCDB\IQCInspectionController@iqcdbdelete',
            //     'name' => 'iqcdbdelete'
            // ]);
            // Route::post('/cliqcdbsave', [
            //     'uses' => 'QCDB\IQCInspectionController@cliqcdbsave',
            //     'name' => 'cliqcdbsave'
            // ]);
            //
            // Route::post('/rqiqcdbsave', [
            //     'uses' => 'QCDB\IQCInspectionController@rqiqcdbsave',
            //     'name' => 'rqiqcdbsave'
            // ]);
            // Route::get('/rqiqcdbedit', [
            //     'uses' => 'QCDB\IQCInspectionController@rqiqcdbedit',
            //     'name' => 'rqiqcdbedit'
            // ]);
            // Route::get('/cliqcdbedit', [
            //     'uses' => 'QCDB\IQCInspectionController@cliqcdbedit',
            //     'name' => 'cliqcdbedit'
            // ]);
            // Route::get('/rqiqcdbdelete', [
            //     'uses' => 'QCDB\IQCInspectionController@rqiqcdbdelete',
            //     'name' => 'rqiqcdbdelete'
            // ]);
            // Route::post('/iqc_mod_ins', [
            //     'uses' => 'QCDB\IQCInspectionController@iqc_mod_ins_save',
            //     'name' => 'iqc_mod_ins'
            // ]);
            // Route::post('/iqc_mod_cl', [
            //     'uses' => 'QCDB\IQCInspectionController@iqc_mod_cl_save',
            //     'name' => 'iqc_mod_cl'
            // ]);
            // Route::post('/iqc_mod_rq', [
            //     'uses' => 'QCDB\IQCInspectionController@iqc_mod_rq_save',
            //     'name' => 'iqc_mod_rq'
            // ]);
            // Route::get('/iqc_mod_edit_ins', [
            //     'uses' => 'QCDB\IQCInspectionController@iqc_mod_edit_ins',
            //     'name' => 'iqc_mod_edit_ins'
            // ]);
            // Route::get('/iqc_mod_edit_cl', [
            //     'uses' => 'QCDB\IQCInspectionController@iqc_mod_edit_cl',
            //     'name' => 'iqc_mod_edit_cl'
            // ]);
            // Route::get('/iqc_mod_edit_rq', [
            //     'uses' => 'QCDB\IQCInspectionController@iqc_mod_edit_rq',
            //     'name' => 'iqc_mod_edit_rq'
            // ]);
            // Route::get('/iqc_mod_delete_ins', [
            //     'uses' => 'QCDB\IQCInspectionController@iqc_mod_delete_ins',
            //     'name' => 'iqc_mod_delete_ins'
            // ]);
            // Route::get('/iqc_mod_delete_cl', [
            //     'uses' => 'QCDB\IQCInspectionController@iqc_mod_delete_cl',
            //     'name' => 'iqc_mod_delete_cl'
            // ]);
            // Route::get('/iqc_mod_delete_rq', [
            //     'uses' => 'QCDB\IQCInspectionController@iqc_mod_delete_rq',
            //     'name' => 'iqc_mod_delete_rq'
            // ]);
            // Route::post('/iqcdbgroupby', [
            //     'uses' => 'QCDB\IQCInspectionController@iqcdbgroupby',
            //     'name' => 'iqcdbgroupby'
            // ]);
            // Route::post('/iqcdbselectgroupby1', [
            //     'uses' => 'QCDB\IQCInspectionController@iqcdbselectgroupby1',
            //     'name' => 'iqcdbselectgroupby1'
            // ]);
            // Route::get('/get_no_of_defectives_ins', [
            //     'uses' => 'QCDB\IQCInspectionController@get_no_of_defectives_ins',
            //     'name' => 'get_no_of_defectives_ins'
            // ]);
            // Route::get('/get_no_of_defectives_cl', [
            //     'uses' => 'QCDB\IQCInspectionController@get_no_of_defectives_cl',
            //     'name' => 'get_no_of_defectives_cl'
            // ]);
            // Route::get('/get_no_of_defectives_rq', [
            //     'uses' => 'QCDB\IQCInspectionController@get_no_of_defectives_rq',
            //     'name' => 'get_no_of_defectives_rq'
            // ]);
            // Route::get('/displaymodins', [
            //     'uses' => 'QCDB\IQCInspectionController@displaymodins',
            //     'name' => 'displaymodins'
            // ]);
            // Route::get('/displaymodcl', [
            //     'uses' => 'QCDB\IQCInspectionController@displaymodcl',
            //     'name' => 'displaymodcl'
            // ]);
            // Route::get('/displaymodrq', [
            //     'uses' => 'QCDB\IQCInspectionController@displaymodrq',
            //     'name' => 'displaymodrq'
            // ]);
            // Route::get('/get_iqcpercentage', [
            //     'uses' => 'QCDB\IQCInspectionController@get_iqcpercentage',
            //     'name' => 'get_iqcpercentage'
            // ]);
            //
            // Route::get('/searchby', [
            //     'uses' => 'QCDB\IQCInspectionController@searchby',
            //     'name' => 'searchby'
            // ]);
            // Route::get('/getlarlrrdppm', [
            //     'uses' => 'QCDB\IQCInspectionController@getlarlrrdppm',
            //     'name' => 'getlarlrrdppm'
            // ]);
            //
            // Route::get('/getrejected', [
            //     'uses' => 'QCDB\IQCInspectionController@getrejected',
            //     'name' => 'getrejected'
            // ]);


        /* OQC Inspection */
            Route::get('/oqcinspection', [
                'uses' => 'QCDB\OQCInspectionController@index',
                'name' => 'oqcinspection'
            ]);

            Route::post('/getpodetails', [
                'uses' => 'QCDB\OQCInspectionController@getPOdetails',
                'name' => 'getpodetails'
            ]);

            Route::get('/oqc-datatable', [
                'uses' => 'QCDB\OQCInspectionController@OQCDataTable',
                'name' => 'oqc_datatable'
            ]);

            Route::get('/oqc-mod-datatable', [
                'uses' => 'QCDB\OQCInspectionController@ModDataTable',
                'name' => 'oqc-mod-datatable'
            ]);

            Route::post('/oqc-save-inspection', [
                'uses' => 'QCDB\OQCInspectionController@saveInspection',
                'name' => 'oqc-save-inspection'
            ]);

            Route::post('/oqc-delete-inspection', [
                'uses' => 'QCDB\OQCInspectionController@deleteInspection',
                'name' => '/oqc-delete-inspection'
            ]);

            Route::post('/oqc-delete-mod', [
                'uses' => 'QCDB\OQCInspectionController@deleteModeOfDefects',
                'name' => '/oqc-delete-mod'
            ]);

            Route::get('/oqc-workweek', [
                'uses' => 'QCDB\OQCInspectionController@getWorkWeek',
                'name' => 'oqc-workweek'
            ]);

            Route::post('/oqc-save-mod', [
                'uses' => 'QCDB\OQCInspectionController@saveModeOfDefects',
                'name' => 'oqc-save-mod'
            ]);

            Route::get('/oqc-pdf', [
                'uses' => 'QCDB\OQCInspectionController@PDFReport',
                'name' => 'oqc-pdf'
            ]);

            Route::get('/oqc-excel', [
                'uses' => 'QCDB\OQCInspectionController@ExcelReport',
                'name' => 'oqc-excel'
            ]);

            Route::get('/oqc-groupby-values', [
                'uses' => 'QCDB\OQCInspectionController@GroupByValues',
                'name' => 'oqc-groupby-values'
            ]);

            Route::get('/oqc-initiatedata', [
                'uses' => 'QCDB\OQCInspectionController@initData',
                'name' => 'oqc-initiatedata'
            ]);

            Route::get('/oqc-getprobitems', [
                'uses' => 'QCDB\OQCInspectionController@getProbeItems',
                'name' => 'oqc-getprobitems'
            ]);

            Route::get('/getprobeproduct', [
                'uses' => 'QCDB\OQCInspectionController@getProbeProduct',
                'name' => 'getprobeproduct'
            ]);

            Route::get('/get-sampling-plan', [
                'uses' => 'QCDB\OQCInspectionController@SamplingPlan',
                'name' => 'get-sampling-plan'
            ]);

            Route::get('/oqc-num-of-defects', [
                'uses' => 'QCDB\OQCInspectionController@getNumOfDefectives',
                'name' => 'oqc-num-of-defects'
            ]);


            Route::post('/oqc-calculate-dppm', [
                'uses' => 'QCDB\OQCGroupByController@CalculateDPPM',
                'name' => 'oqc-calculate-dppm'
            ]);

            Route::get('/oqc-shift', [
                'uses' => 'QCDB\OQCInspectionController@getShift',
                'name' => 'oqc-shift'
            ]);






            // Route::get('/oqcinspection', [
            //     'uses' => 'QCDB\OQCInspectionController@getOQCInspection',
            //     'name' => 'oqcinspection'
            // ]);

            // Route::get('/oqcinspectiondata', [
            //     'uses' => 'QCDB\OQCInspectionController@getOQCInspectionData',
            //     'name' => 'oqcinspectiondata'
            // ]);
            // Route::post('/oqcdbsave', [
            //     'uses' => 'QCDB\OQCInspectionController@oqcsave',
            //     'name' => 'oqcdbsave'
            // ]);
            //  Route::get('/oqcdbdelete', [
            //     'uses' => 'QCDB\OQCInspectionController@oqcdbdelete',
            //     'name' => 'oqcdbdelete'
            // ]);
            // Route::post('/oqcmodinspectionsave', [
            //     'uses' => 'QCDB\OQCInspectionController@oqcmodinspectionsave',
            //     'name' => 'oqcmodinspectionsave'
            // ]);
            // Route::get('/oqcmodinspectionedit', [
            //     'uses' => 'QCDB\OQCInspectionController@oqcmodinspectionedit',
            //     'name' => 'oqcmodinspectionedit'
            // ]);
            // Route::get('/oqcmodinspectiondelete', [
            //     'uses' => 'QCDB\OQCInspectionController@oqcmodinspectiondelete',
            //     'name' => 'oqcmodinspectiondelete'
            // ]);
            // Route::get('/getYPICSrecords', [
            //     'uses' => 'QCDB\OQCInspectionController@getYPICSrecords',
            //     'name' => 'getYPICSrecords'
            // ]);
            // Route::get('/get_no_of_defectives', [
            //     'uses' => 'QCDB\OQCInspectionController@get_no_of_defectives',
            //     'name' => 'get_no_of_defectives'
            // ]);
            // Route::get('/oqcsearchby', [
            //     'uses' => 'QCDB\OQCInspectionController@searchby',
            //     'name' => 'oqcsearchby'
            // ]);
            // Route::get('/oqcprintreport', [
            //     'uses' => 'QCDB\OQCInspectionController@getOQCreport',
            //     'name' => 'oqcprintreport'
            // ]);
            // Route::get('/oqcinsprintreportexcel', [
            //     'uses' => 'QCDB\OQCInspectionController@getOQCreportexcel',
            //     'name' => 'oqcinsprintreportexcel'
            // ]);
            // Route::get('/getFamily', [
            //     'uses' => 'QCDB\OQCInspectionController@getFamily',
            //     'name' => 'getFamily'
            // ]);
            //  Route::get('/displayoqcmod', [
            //     'uses' => 'QCDB\OQCInspectionController@displayoqcmod',
            //     'name' => 'displayoqcmod'
            // ]);
            // Route::post('/oqcdbgroupby', [
            //     'uses' =>'QCDB\OQCInspectionController@oqcdbgroupby',
            //     'name' => 'oqcdbgroupby'
            // ]);
            // Route::post('/oqcdbselectgroupby1', [
            //     'uses' => 'QCDB\OQCInspectionController@oqcdbselectgroupby1',
            //     'name' => 'oqcdbselectgroupby1'
            // ]);
            // Route::get('/getoqclarlrrdppm', [
            //     'uses' => 'QCDB\OQCInspectionController@getlarlrrdppm',
            //     'name' => 'getoqclarlrrdppm'
            // ]);
            // Route::get('/getoqctotallarlrrdppm', [
            //     'uses' => 'QCDB\OQCInspectionController@totallarlrrdppm',
            //     'name' => 'getoqctotallarlrrdppm'
            // ]);
            // Route::get('/getmodoqc', [
            //     'uses' => 'QCDB\OQCInspectionController@getmodoqc',
            //     'name' => 'getmodoqc'
            // ]);
            // Route::get('/countdefects', [
            //     'uses' => 'QCDB\OQCInspectionController@countdefects',
            //     'name' => 'countdefects'
            // ]);
            // Route::get('/getmodcount', [
            //     'uses' => 'QCDB\OQCInspectionController@getmodcount',
            //     'name' => 'getmodcount'
            // ]);

            // Route::get('/getmodcounts', [
            //     'uses' => 'QCDB\OQCInspectionController@getmodcounts',
            //     'name' => 'getmodcounts'
            // ]);
            // Route::get('/getrows', [
            //     'uses' => 'QCDB\OQCInspectionController@getrows',
            //     'name' => 'getrows'
            // ]);
            // Route::get('/time', [
            //     'uses' => 'QCDB\OQCInspectionController@time',
            //     'name' => 'time'
            // ]);
            // Route::get('/countlotno', [
            //     'uses' => 'QCDB\OQCInspectionController@countlotno',
            //     'name' => 'countlotno'
            // ]);
            // Route::get('/getprobeproduct', [
            //     'uses' => 'QCDB\OQCInspectionController@getProbeProduct',
            //     'name' => 'getprobeproduct'
            // ]);





            

        /* FGS */
            Route::get('/fgs', [
                'uses' => 'QCDB\FGSController@getFGS',
                'name' => 'fgs'
            ]);
            Route::get('/FGSgetrows', [
                'uses' => 'QCDB\FGSController@FGSgetrows',
                'name' => 'FGSgetrows'
            ]);

            Route::get('/fgsdata', [
                'uses' => 'QCDB\FGSController@getFGSData',
                'name' => 'fgsdata'
            ]);

            Route::post('/fgsSave', [
                'uses' => 'QCDB\FGSController@fgsSave',
                'name' => 'fgsSave'
            ]);
            Route::get('/fgsDelete', [
                'uses' => 'QCDB\FGSController@fgsDelete',
                'name' => 'fgsDelete'
            ]);
            Route::get('/getfgsYPICSrecords', [
                'uses' => 'QCDB\FGSController@getfgsYPICSrecords',
                'name' => 'getfgsYPICSrecords'
            ]);
            Route::get('/fgssearchby', [
                'uses' => 'QCDB\FGSController@searchby',
                'name' => 'fgssearchby'
            ]);
            Route::get('/fgsprintreport', [
                'uses' => 'QCDB\FGSController@getFGSreport',
                'name' => 'fgsprintreport'
            ]);
            Route::get('/fgsprintreportexcel', [
                'uses' => 'QCDB\FGSController@getFGSreportexcel',
                'name' => 'fgsprintreportexcel'
            ]);
            Route::post('/fgsdbselectgroupby1', [
                'uses' => 'QCDB\FGSController@fgsdbselectgroupby1',
                'name' => 'fgsdbselectgroupby1'
            ]);
            Route::post('/fgsdbgroupby', [
                'uses' =>'QCDB\FGSController@fgsdbgroupby',
                'name' => 'fgsdbgroupby'
            ]);

        /* Packing Inspection*/
            Route::get('/packinginspection', [
                'uses' => 'QCDB\PackingInspectionController@getPackingInspection',
                'name' => 'packinginspection'
            ]);
            Route::get('/packgetrows', [
                'uses' => 'QCDB\PackingInspectionController@packgetrows',
                'name' => 'packgetrows'
            ]);

            Route::get('/packinginspection-initdata', [
                'uses' => 'QCDB\PackingInspectionController@initData',
                'name' => 'packinginspection-initdata'
            ]);

            Route::get('/packinginspectiondata', [
                'uses' => 'QCDB\PackingInspectionController@getPackingInspectionData',
                'name' => 'packinginspectiondata'
            ]);
            Route::post('/packingSave', [
                'uses' => 'QCDB\PackingInspectionController@packingSave',
                'name' => 'packingSave'
            ]);
            Route::post('/packing_runcard_Save', [
                'uses' => 'QCDB\PackingInspectionController@packing_runcard_Save',
                'name' => 'packing_runcard_Save'
            ]);
            Route::get('/packing_runcard_edit', [
                'uses' => 'QCDB\PackingInspectionController@packing_runcard_edit',
                'name' => 'packing_runcard_edit'
            ]);

            Route::get('/packingDelete', [
                'uses' => 'QCDB\PackingInspectionController@packingDelete',
                'name' => 'packingDelete'
            ]);
            Route::get('/rcpackingDelete', [
                'uses' => 'QCDB\PackingInspectionController@rcpackingDelete',
                'name' => 'rcpackingDelete'
            ]);
            Route::get('/rcpackingEdit', [
                'uses' => 'QCDB\PackingInspectionController@rcpackingEdit',
                'name' => 'rcpackingEdit'
            ]);

            Route::get('/displayruncard', [
                'uses' => 'QCDB\PackingInspectionController@displayruncard',
                'name' => 'displayruncard'
            ]);
            Route::get('/display_runcard', [
                'uses' => 'QCDB\PackingInspectionController@display_runcard',
                'name' => 'display_runcard'
            ]);
            Route::get('/getpackingYPICSrecords', [
                'uses' => 'QCDB\PackingInspectionController@getpackingYPICSrecords',
                'name' => 'getpackingYPICSrecords'
            ]);
            Route::get('/getlot', [
                'uses' => 'QCDB\PackingInspectionController@getlot',
                'name' => 'getlot'
            ]);
            Route::get('/getmod', [
                'uses' => 'QCDB\PackingInspectionController@getmod',
                'name' => 'getmod'
            ]);
            Route::get('/packingsearchby', [
                'uses' => 'QCDB\PackingInspectionController@searchby',
                'name' => 'packingsearchby'
            ]);
            Route::get('/packingprintreport', [
                'uses' => 'QCDB\PackingInspectionController@getPACKINGreport',
                'name' => 'packingprintreport'
            ]);
            Route::get('/packingprintreportexcel', [
                'uses' => 'QCDB\PackingInspectionController@getPACKINGreportexcel',
                'name' => 'packingprintreportexcel'
            ]);

            Route::get('/displaypackmod', [
                'uses' => 'QCDB\PackingInspectionController@displaypackmod',
                'name' => 'displaypackmod'
            ]);
            Route::post('/packmod_save', [
                'uses' => 'QCDB\PackingInspectionController@packmod_save',
                'name' => 'packmod_save'
            ]);
            Route::get('/packmod_edit', [
                'uses' => 'QCDB\PackingInspectionController@packmod_edit',
                'name' => 'packmod_edit'
            ]);
            Route::get('/packmod_delete', [
                'uses' => 'QCDB\PackingInspectionController@packmod_delete',
                'name' => 'packmod_delete'
            ]);
            Route::get('/getTotalmod', [
                'uses' => 'QCDB\PackingInspectionController@getTotalmod',
                'name' => 'getTotalmod'
            ]);
            Route::get('/getTotalruncard', [
                'uses' => 'QCDB\PackingInspectionController@getTotalruncard',
                'name' => 'getTotalruncard'
            ]);
            Route::post('/packingselectgroupby1', [
                'uses' => 'QCDB\PackingInspectionController@packingselectgroupby1',
                'name' => 'packingselectgroupby1'
            ]);
            Route::post('/packingdbgroupby', [
                'uses' =>'QCDB\PackingInspectionController@packingdbgroupby',
                'name' => 'packingdbgroupby'
            ]);

        /*PACKING MOLDING*/
            Route::get('/packingmolding', [
                'uses' => 'QCMLD\PackingMoldingController@getPackingMolding',
                'name' => 'packingmolding'
            ]);
            Route::get('/packmoldgetrows', [
                'uses' => 'QCMLD\PackingMoldingController@packmoldgetrows',
                'name' => 'packmoldgetrows'
            ]);

            Route::get('/packingMOLDINGdata', [
                'uses' => 'QCMLD\PackingMoldingController@getPackingInspectionDataM',
                'name' => 'packingMOLDINGdata'
            ]);

            Route::get('/packingMOLDINGprintreport', [
                'uses' => 'QCMLD\PackingMoldingController@getPackingreportM',
                'name' => 'packingMOLDINGprintreport'
            ]);
            Route::post('/packingMOLDINGSave', [
                'uses' => 'QCMLD\PackingMoldingController@packingSaveM',
                'name' => 'packingMOLDINGSave'
            ]);
            Route::post('/packingMOLDING_runcard_Save', [
                'uses' => 'QCMLD\PackingMoldingController@packing_runcard_SaveM',
                'name' => 'packingMOLDING_runcard_Save'
            ]);
            Route::get('/packingMOLDING_runcard_edit', [
                'uses' => 'QCMLD\PackingMoldingController@packing_runcard_editM',
                'name' => 'packingMOLDING_runcard_edit'
            ]);

            Route::get('/packingMOLDINGDelete', [
                'uses' => 'QCMLD\PackingMoldingController@packingDeleteM',
                'name' => 'packingMOLDINGDelete'
            ]);
            Route::get('/rcpackingMOLDINGDelete', [
                'uses' => 'QCMLD\PackingMoldingController@rcpackingDeleteM',
                'name' => 'rcpackingMOLDINGDelete'
            ]);
            Route::get('/rcpackingMOLDINGEdit', [
                'uses' => 'QCMLD\PackingMoldingController@rcpackingEditM',
                'name' => 'rcpackingMOLDINGEdit'
            ]);

            Route::get('/displayMOLDINGruncard', [
                'uses' => 'QCMLD\PackingMoldingController@displayruncardM',
                'name' => 'displayMOLDINGruncard'
            ]);
            Route::get('/displayMOLDING_runcard', [
                'uses' => 'QCMLD\PackingMoldingController@display_runcardM',
                'name' => 'displayMOLDING_runcard'
            ]);
            Route::get('/getpackingMOLDINGYPICSrecords', [
                'uses' => 'QCMLD\PackingMoldingController@getpackingYPICSrecordsM',
                'name' => 'getpackingMOLDINGYPICSrecords'
            ]);
            Route::get('/getMOLDINGlot', [
                'uses' => 'QCMLD\PackingMoldingController@getlotM',
                'name' => 'getMOLDINGlot'
            ]);
            Route::get('/getMOLDINGmod', [
                'uses' => 'QCMLD\PackingMoldingController@getmodM',
                'name' => 'getMOLDINGmod'
            ]);
            Route::get('/packingMOLDINGsearchby', [
                'uses' => 'QCMLD\PackingMoldingController@searchbyM',
                'name' => 'packingMOLDINGsearchby'
            ]);
            Route::get('/packingMOLDINGprintreport', [
                'uses' => 'QCMLD\PackingMoldingController@getPACKINGreportM',
                'name' => 'packingMOLDINGprintreport'
            ]);
            Route::get('/packingMOLDINGprintreportexcel', [
                'uses' => 'QCMLD\PackingMoldingController@getPACKINGreportexcelM',
                'name' => 'packingMOLDINGprintreportexcel'
            ]);

            Route::get('/displayMOLDINGpackmod', [
                'uses' => 'QCMLD\PackingMoldingController@displaypackmodM',
                'name' => 'displayMOLDINGpackmod'
            ]);
            Route::post('/packMOLDINGmod_save', [
                'uses' => 'QCMLD\PackingMoldingController@packmod_saveM',
                'name' => 'packMOLDINGmod_save'
            ]);
            Route::get('/packMOLDINGmod_edit', [
                'uses' => 'QCMLD\PackingMoldingController@packmod_editM',
                'name' => 'packMOLDINGmod_edit'
            ]);
            Route::get('/packMOLDINGmod_delete', [
                'uses' => 'QCMLD\PackingMoldingController@packmod_deleteM',
                'name' => 'packMOLDINGmod_delete'
            ]);
            Route::get('/getTotalMOLDINGmod', [
                'uses' => 'QCMLD\PackingMoldingController@getTotalmodM',
                'name' => 'getTotalMOLDINGmod'
            ]);
            Route::get('/getTotalMOLDINGruncard', [
                'uses' => 'QCMLD\PackingMoldingController@getTotalruncardM',
                'name' => 'getTotalMOLDINGruncard'
            ]);
            Route::post('/packingMOLDINGselectgroupby1', [
                'uses' => 'QCMLD\PackingMoldingController@packingselectgroupby1M',
                'name' => 'packingMOLDINGselectgroupby1'
            ]);
            Route::post('/packingMOLDINGdbgroupby', [
                'uses' =>'QCMLD\PackingMoldingController@packingdbgroupbyM',
                'name' => 'packingMOLDINGdbgroupby'
            ]);
            Route::get('/packingsearchbyM', [
                'uses' => 'QCMLD\PackingMoldingController@searchbyM',
                'name' => 'packingsearchbyM'
            ]);

        /*YPICS INVOICING*/
            Route::get('/ypicsinvoicing', [
                'uses' => 'Phase3\YPICSInvoicingController@getInvoicing',
                'name' => 'ypicsinvoicing'
            ]);

            Route::get('/tblsummarydata', [
                'uses' => 'Phase3\YPICSInvoicingController@postSummaryData',
                'name' => 'tblsummarydata'
            ]);

            Route::get('/getpackinglistdatatable', [
                'uses' => 'Phase3\YPICSInvoicingController@getPackingListData',
                'name' => 'getpackinglistdatatable'
            ]);

            Route::get('/getinvoicedatatable', [
                'uses' => 'Phase3\YPICSInvoicingController@getInvoiceData',
                'name' => 'getinvoicedatatable'
            ]);

            Route::get('/detailsypicsinvoicing/{ctrl}', [
                'uses' => 'Phase3\YPICSInvoicingController@getDetailsInvoicing',
                'name' => 'detailsypicsinvoicing'
            ]);

            Route::post('/deleteinvoicedetails', [
                'uses' => 'Phase3\YPICSInvoicingController@deleteInvoice',
                'name' => 'deleteinvoicedetails'
            ]);

            Route::get('/getdetails', [
                'uses' => 'Phase3\YPICSInvoicingController@getDetails',
                'name' => 'getdetails'
            ]);

            Route::get('/getdetailsbyproduct', [
                'uses' => 'Phase3\YPICSInvoicingController@getDetailsByProduct',
                'name' => 'getdetailsbyproduct'
            ]);

            Route::get('/getinitdetails', [
                'uses' => 'Phase3\YPICSInvoicingController@getInitDetails',
                'name' => 'getinitdetails'
            ]);

            Route::get('/getncv', [
                'uses' => 'Phase3\YPICSInvoicingController@getNCV',
                'name' => 'getncv'
            ]);

            Route::get('/getcarrier', [
                'uses' => 'Phase3\YPICSInvoicingController@carrier',
                'name' => 'getcarrier'
            ]);

            Route::get('/getdescgoods', [
                'uses' => 'Phase3\YPICSInvoicingController@descOfGoods',
                'name' => 'getdescgoods'
            ]);

            Route::get('/getpod', [
                'uses' => 'Phase3\YPICSInvoicingController@portOfDestination',
                'name' => 'getpod'
            ]);

            Route::post('/savedetails', [
                'uses' => 'Phase3\YPICSInvoicingController@postSaveDetails',
                'name' => 'savedetails'
            ]);

            Route::get('/printinvoicing/{ctrl}', [
                'uses' => 'Phase3\YPICSInvoicingController@getPrintOut',
                'name' => 'printinvoicing'
            ]);

            Route::get('/invoicesummary', [
                'uses' => 'Phase3\YPICSInvoicingController@getInvoiceSummary',
                'name' => 'invoicesummary'
            ]);

            Route::get('/shippinglist', [
                'uses' => 'Phase3\YPICSInvoicingController@getShippingList',
                'name' => 'shippinglist'
            ]);

            Route::get('/salesreport', [
                'uses' => 'Phase3\YPICSInvoicingController@getSalesReport',
                'name' => 'salesreport'
            ]);

            Route::post('/edit-draftshipment', [
                'uses' => 'Phase3\YPICSInvoicingController@editDraftShipment',
                'name' => 'edit-draftshipment'
            ]);

            Route::get('/invoicestatus', [
                'uses' => 'Phase3\YPICSInvoicingController@getInvoiceStatus',
                'name' => 'invoicestatus'
            ]);

        /*YIELD PERFORMANCE*/
            Route::get('/yieldperformance', [
                'uses' => 'Phase3\YieldPerformanceController@getYieldPerformance',
                'name' => 'yieldperformance'
            ]);
            Route::post('/yieldperformance', [
                'uses' => 'Phase3\YieldPerformanceController@getYieldPerformance',
                'name' => 'yieldperformance'
            ]);

            Route::get('/get-poregistration' ,[
                'uses' => 'Phase3\YieldPerformanceController@getporeg',
                'name' => 'get-poregistration'
            ]);
            Route::get('/get-deviceregistration' ,[
                'uses' => 'Phase3\YieldPerformanceController@getdevicereg',
                'name' => 'get-deviceregistration'
            ]);
            Route::get('/get-seriesregistration' ,[
                'uses' => 'Phase3\YieldPerformanceController@getseriesreg',
                'name' => 'get-seriesregistration'
            ]);
            Route::get('/get-modregistration' ,[
                'uses' => 'Phase3\YieldPerformanceController@getmodreg',
                'name' => 'get-modregistration'
            ]);

            Route::get('/displayporeg', [
                'uses' => 'Phase3\YieldPerformanceController@displayporeg',
                'name' => 'displayporeg'
            ]);
            Route::get('/displaydevicereg', [
                'uses' => 'Phase3\YieldPerformanceController@displaydevicereg',
                'name' => 'displaydevicereg'
            ]);
            Route::get('/displayseriesreg', [
                'uses' => 'Phase3\YieldPerformanceController@displayseriesreg',
                'name' => 'displayseriesreg'
            ]);
            Route::get('/displaymodreg', [
                'uses' => 'Phase3\YieldPerformanceController@displaymodreg',
                'name' => 'displaymodreg'
            ]);
            Route::get('/deleteAll-yieldperformance', [
                'uses' => 'Phase3\YieldPerformanceController@deleteAll',
                'name' => 'deleteAll-yieldperformance'
            ]);
            Route::get('/deleteAllporeg', [
                'uses' => 'Phase3\YieldPerformanceController@deleteporeg',
                'name' => 'deleteAllporeg'
            ]);
            Route::get('/deleteAlldevicereg', [
                'uses' => 'Phase3\YieldPerformanceController@deletedevicereg',
                'name' => 'deleteAlldevicereg'
            ]);
            Route::get('/deleteAllseriesreg', [
                'uses' => 'Phase3\YieldPerformanceController@deleteseriesreg',
                'name' => 'deleteAllseriesreg'
            ]);
            Route::get('/deleteAllmodreg', [
                'uses' => 'Phase3\YieldPerformanceController@deletemodreg',
                'name' => 'deleteAllmodreg'
            ]);
            Route::get('/deleteAlltargetreg', [
                'uses' => 'Phase3\YieldPerformanceController@deletetargetreg',
                'name' => 'deleteAlltargetreg'
            ]);
            Route::get('/deleteyieldingsummary' ,[
                'uses' => 'Phase3\YieldPerformanceController@deleteAllPost',
                'name' => 'deleteyieldingsummary'
            ]);
            Route::post('/update-yieldsummary' ,[
                'uses' => 'Phase3\YieldPerformanceController@udpateyieldsummary',
                'name' => 'update-yieldsummary'
            ]);

            Route::post('/add-poregistration', [
                'uses' => 'Phase3\YieldPerformanceController@poregistration',
                'name' => 'add-poregistration'
            ]);
            Route::post('/display-poregistration', [
                'uses' => 'Phase3\YieldPerformanceController@displayporegistration',
                'name' => 'display-poregistration'
            ]);
            Route::post('/add-deviceregistration', [
                'uses' => 'Phase3\YieldPerformanceController@deviceregistration',
                'name' => 'add-deviceregistration'
            ]);
            Route::post('/display-deviceregistration', [
                'uses' => 'Phase3\YieldPerformanceController@displaydeviceregistration',
                'name' => 'display-deviceregistration'
            ]);

            Route::post('/add-seriesregistration', [
                'uses' => 'Phase3\YieldPerformanceController@seriesregistration',
                'name' => 'add-seriesregistration'
            ]);

            Route::post('/add-modregistration', [
                'uses' => 'Phase3\YieldPerformanceController@modregistration',
                'name' => 'add-modregistration'
            ]);
            Route::post('/add-targetreg', [
                'uses' => 'Phase3\YieldPerformanceController@targetregistration',
                'name' => 'add-targetreg'
            ]);

            Route::get('/editporeg' ,[
                'uses' => 'Phase3\YieldPerformanceController@editporeg',
                'name' => 'editporeg'
            ]);
            Route::get('/editdevicereg' ,[
                'uses' => 'Phase3\YieldPerformanceController@editdevicereg',
                'name' => 'editdevicereg'
            ]);
            Route::get('/editseriesreg' ,[
                'uses' => 'Phase3\YieldPerformanceController@editseriesreg',
                'name' => 'editseriesreg'
            ]);
            Route::get('/editmodreg' ,[
                'uses' => 'Phase3\YieldPerformanceController@editmodreg',
                'name' => 'editmodreg'
            ]);
			Route::get('/edittargetreg' ,[
                'uses' => 'Phase3\YieldPerformanceController@edittargetreg',
                'name' => 'edittargetreg'
            ]);
            Route::post('/update-poregistration', [
                'uses' => 'Phase3\YieldPerformanceController@updateporegistration',
                'name' => 'update-poregistration'
            ]);
            Route::post('/update-deviceregistration', [
                'uses' => 'Phase3\YieldPerformanceController@updatedeviceregistration',
                'name' => 'update-deviceregistration'
            ]);
            Route::post('/update-seriesregistration', [
                'uses' => 'Phase3\YieldPerformanceController@updateseriesregistration',
                'name' => 'update-seriesregistration'
            ]);
            Route::post('/update-modregistration', [
                'uses' => 'Phase3\YieldPerformanceController@updatemodregistration',
                'name' => 'update-modregistration'
            ]);
            Route::get('/export-to-excel', [
                'uses' => 'Phase3\YieldPerformanceController@exportToexcel',
                'name' => 'export-to-excel'
            ]);
            Route::get('/export-to-pdf', [
                'uses' => 'Phase3\YieldPerformanceController@exportTopdf',
                'name' => '/export-to-pdf'
            ]);
            Route::get('/summarychart', [
                'uses' => 'Phase3\YieldPerformanceController@summarychart',
                'name' => '/summarychart'
            ]);
            Route::get('/summaryRpt', [
                'uses' => 'Phase3\YieldPerformanceController@summaryRpt',
                'name' => '/summaryRpt'
            ]);
             Route::get('/summaryREpt', [
                'uses' => 'Phase3\YieldPerformanceController@summaryREpt',
                'name' => '/summaryREpt'
            ]);
            /*Route::get('/summaryREptpdf', [
                'uses' => 'Phase3\YieldPerformanceController@summaryREptpdf',
                'name' => '/summaryREptpdf'
            ]);*/
            Route::get('/defectsummaryRpt', [
                'uses' => 'Phase3\YieldPerformanceController@defectsummaryRpt',
                'name' => '/defectsummaryRpt'
            ]);
            /*Route::get('/defectsummaryRptpdf', [
                'uses' => 'Phase3\YieldPerformanceController@defectsummaryRptpdf',
                'name' => '/defectsummaryRptpdf'
            ]);*/
            Route::get('/yieldsumRpt', [
                'uses' => 'Phase3\YieldPerformanceController@yieldsumRpt',
                'name' => '/yieldsumRpt'
            ]);
            Route::get('/yieldsumRptpdf', [
                'uses' => 'Phase3\YieldPerformanceController@yieldsumRptpdf',
                'name' => '/yieldsumRptpdf'
            ]);
            Route::get('/yieldsumfamRpt', [
                'uses' => 'Phase3\YieldPerformanceController@yieldsumfamRpt',
                'name' => '/yieldsumfamRpt'
            ]);
            Route::get('/yieldsumfamRptpdf', [
                'uses' => 'Phase3\YieldPerformanceController@yieldsumfamRptpdf',
                'name' => '/yieldsumfamRptpdf'
            ]);
            Route::get('/summaryRptPdf', [
                'uses' => 'Phase3\YieldPerformanceController@summaryRptPdf',
                'name' => '/summaryRptPdf'
            ]);
            Route::post('/loadchart', [
                'uses' => 'Phase3\YieldPerformanceController@loadchart',
                'name' => '/loadchart'
            ]);
            Route::get('/getponoreg', [
                'uses' => 'Phase3\YieldPerformanceController@getponoreg',
                'name' => '/getponoreg'
            ]);
            Route::post('/devreg_get_series', [
                'uses' => 'Phase3\YieldPerformanceController@devreg_get_series',
                'name' => '/devreg_get_series'
            ]);

        // yieldperformance2---------------------------------------------
            Route::get('/addnewYieldperformance', [
                'uses' => 'Phase3\AddnewYieldingPerformanceController@getYieldPerformance',
                'name' => 'addnewYieldperformance'
            ]);
            Route::post('/addnewYieldperformance', [
                'uses' => 'Phase3\AddnewYieldingPerformanceController@getYieldPerformance',
                'name' => 'addnewYieldperformance'
            ]);
            Route::get('/displaypya', [
                'uses' => 'Phase3\AddnewYieldingPerformanceController@displaypya',
                'name' => 'displaypya'
            ]);
            Route::get('/searchdisplaypya', [
                'uses' => 'Phase3\AddnewYieldingPerformanceController@searchdisplaypya',
                'name' => 'searchdisplaypya'
            ]);
            Route::post('/displaypya', [
                'uses' => 'Phase3\AddnewYieldingPerformanceController@displaypya',
                'name' => 'displaypya'
            ]);
            Route::get('/displaycmq', [
                'uses' => 'Phase3\AddnewYieldingPerformanceController@displaycmq',
                'name' => 'displaycmq'
            ]);
            Route::get('/searchdisplaycmq', [
                'uses' => 'Phase3\AddnewYieldingPerformanceController@searchdisplaycmq',
                'name' => 'searchdisplaycmq'
            ]);
            Route::post('/displaycmq', [
                'uses' => 'Phase3\AddnewYieldingPerformanceController@displaycmq',
                'name' => 'displaycmq'
            ]);
            Route::get('/searchdisplaydetails', [
                'uses' => 'Phase3\AddnewYieldingPerformanceController@searchdisplaydetails',
                'name' => 'searchdisplaydetails'
            ]);
            Route::get('/searchdisplaysummary', [
                'uses' => 'Phase3\AddnewYieldingPerformanceController@searchdisplaydetails',
                'name' => 'searchdisplaysummary'
            ]);
            Route::post('/add-yieldperformance2', [
                'uses' => 'Phase3\AddnewYieldingPerformanceController@addYieldperformance',
                'name' => 'add-yieldperformance2'
            ]);

            Route::post('/search-pono2' ,[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@searchPO',
                'name' => 'search-pono2'
            ]);
            Route::post('/search-yieldperformance2' ,[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@search',
                'name' => 'search-yieldperformance2'
            ]);
            Route::post('/multisearch-yieldperformance2' ,[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@multiSearch',
                'name' => 'multisearch-yieldperformance2'
            ]);
            Route::get('/deleteAll-pono2' ,[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@deleteAllPost',
                'name' => 'deleteAll-pono2'
            ]);
            Route::post('/update-yieldperformance2' ,[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@updateYieldperformance',
                'name' => 'update-yieldperformance2'
            ]);
            Route::post('/multiSearchDisplay2' ,[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@multiSearchDisplay',
                'name' => 'multiSearchDisplay2'
            ]);

            Route::get('/get-summarylist' ,[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@summarylist',
                'name' => 'get-summarylist'
            ]);
            Route::get('/searchdisplayMNG',[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@searchdisplayMNG',
                'name' => 'searchdisplayMNG'
            ]);
            Route::get('/searchdisplayPNG',[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@searchdisplayPNG',
                'name' => 'searchdisplayPNG'
            ]);
            Route::get('/searchdisplaytoutput',[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@searchdisplaytoutput',
                'name' => 'searchdisplaytoutput'
            ]);
            Route::get('/searchdisplaytreject',[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@searchdisplaytreject',
                'name' => 'searchdisplaytreject'
            ]);
            Route::get('/searchdisplayYWOMNG',[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@searchdisplayYWOMNG',
                'name' => 'searchdisplayYWOMNG'
            ]);
            Route::get('/searchdisplayTYIELD',[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@searchdisplayTYIELD',
                'name' => 'searchdisplayTYIELD'
            ]);
            Route::get('/searchdisplaydppm',[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@searchdisplaydppm',
                'name' => 'searchdisplaydppm'
            ]);
            Route::get('/getautovalue',[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@getautovalue',
                'name' => 'getautovalue'
            ]);
            Route::post('/dev_get_series', [
                'uses' => 'Phase3\AddnewYieldingPerformanceController@devreg_get_series',
                'name' => '/dev_get_series'
            ]);
            Route::post('/get_mod', [
                'uses' => 'Phase3\AddnewYieldingPerformanceController@get_mod',
                'name' => '/get_mod'
            ]);
            Route::get('/checkdetails', [
                'uses' => 'Phase3\AddnewYieldingPerformanceController@checkdetails',
                'name' => '/checkdetails'
            ]);
             Route::get('/deletecmq' ,[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@deletecmq',
                'name' => 'deletecmq'
            ]);
            Route::get('/deletepya' ,[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@deletepya',
                'name' => 'deletepya'
            ]);
            Route::get('/getpng' ,[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@getpng',
                'name' => 'getpng'
            ]);
            Route::get('/getmng' ,[
                'uses' => 'Phase3\AddnewYieldingPerformanceController@getmng',
                'name' => 'getmng'
            ]);



/*-------------------------------------------------------------------/
*                 DO NOT PASTE YOUR ROUTES HERE
* ------------------------------------------------------------------*/

    /**
     * --------------------------------------------------------------------
     *  Routes for Masters
     *  -------------------------------------------------------------------
     */

        /*UserController*/
            Route::get('/usermaster', 'Master\UserController@index');
            Route::get('/usermaster/create', 'Master\UserController@create');
            Route::get('/usermaster/{id}', 'Master\UserController@edit');
            Route::post('/store', 'Master\UserController@store');
            Route::post('/destory/{id}', 'Master\UserController@destroy');
            Route::post('/update/{id}', 'Master\UserController@update');

        /*ProductlineController*/
            Route::get('/productlines', [
                'uses' => 'Master\ProductlineController@getProductline',
                'name' => 'productlines'
            ]);

            Route::post('/add-product' ,[
                'uses' => 'Master\ProductlineController@postAddProduct',
                'name' => 'add-product'
            ]);

            Route::post('/delete-product' ,[
                'uses' => 'Master\ProductlineController@postDeleteProduct',
                'name' => 'delete-product'
            ]);

            Route::post('/edit-product' ,[
                'uses' => 'Master\ProductlineController@postEditProduct',
                'name' => 'edit-product'
            ]);

        /* Supplier Master Routes*/
            Route::get('/suppliermaster', [
                'uses' => 'Master\SupplierController@getSuppliermaster',
                'name' => 'suppliermaster'
            ]);

            Route::post('/register-supplier', [
                'uses' => 'Master\SupplierController@postRegisterSupplier',
                'name' => 'register-supplier'
            ]);

            Route::post('/update-supplier', [
                'uses' => 'Master\SupplierController@postUpdateSupplier',
                'name' => 'register-supplier'
            ]);

            Route::post('/edit-supplier', [
                'uses' => 'Master\SupplierController@postEditScreen',
                'name' => 'edit-supplier'
            ]);

            Route::post('/delete-supplier', [
                'uses' => 'Master\SupplierController@postDeleteSupplier',
                'name' => 'delete-supplier'
            ]);

        /*Justification Master Routes*/
            Route::get('/justificationmaster', [
                'uses' => 'Master\JustificationController@getJustificationmaster',
                'name' => 'justificationmaster'
            ]);

            Route::post('/register-justification', [
                'uses' => 'Master\JustificationController@postRegisterJustification',
                'name' => 'register-justification'
            ]);

            Route::post('/update-justification', [
                'uses' => 'Master\JustificationController@postUpdateJustification',
                'name' => 'register-justification'
            ]);

            Route::post('/edit-justification', [
                'uses' => 'Master\JustificationController@postEditScreen',
                'name' => 'edit-justification'
            ]);

            Route::post('/delete-justification', [
                'uses' => 'Master\JustificationController@postDeleteJustification',
                'name' => 'delete-justification'
            ]);

        /* DROPDOWN MASTER*/
            Route::get('/dropdown', [
                'uses' => 'Master\DropdownController@getDropdown',
                'name' => 'dropdown'
            ]);
            Route::post('/dropdown', [
                'uses' => 'Master\DropdownController@getDropdown',
                'name' => 'dropdown'
            ]);
            Route::post('/dropdown-save', [
                'uses' => 'Master\DropdownController@postAddDropdown',
                'name' => 'dropdown-save'
            ]);
            Route::post('/dropdown-delete', [
                'uses' => 'Master\DropdownController@postDeleteDropdown',
                'name' => 'dropdown-delete'
            ]);
            Route::post('/dropdown-cat-save', [
                'uses' => 'Master\DropdownController@postAddDropdownCategory',
                'name' => 'dropdown-cat-save'
            ]);
            Route::post('/dropdown-cat-delete', [
                'uses' => 'Master\DropdownController@postDelDropdownCategory',
                'name' => 'dropdown-cat-delete'
            ]);

        /*SOLD TO*/
            Route::get('/sold-to',[
                'uses' => 'Master\SoldToController@getSold',
                'name' => 'sold-to'
            ]);

            Route::post('/add-sold' ,[
                'uses' => 'Master\SoldToController@postAddsold',
                'name' => 'add-sold'
            ]);

            Route::post('/update-sold' ,[
                'uses' => 'Master\SoldToController@updatePost',
                'name' => 'update-sold'
            ]);

            Route::get('/deleteAll-sold' ,[
                'uses' => 'Master\SoldToController@deleteAllPost',
                'name' => 'deleteAll-sold'
            ]);

            Route::post('/search-sold' ,[
                'uses' => 'Master\SoldToController@searchPost',
                'name' => 'search-sold'
            ]);

    /**
     *-------------------------------------------------------------------------
     *  Routes for Phase 1
     * ------------------------------------------------------------------------
     */


        /*MRA*/
            Route::get('/mra', [
                'uses' => 'Phase1\mraController@getMRA',
                'name' => 'mra'
            ]);

            Route::get('/mraload', [
                'uses' => 'Phase1\mraController@getMRAload',
                'name' => 'mraload'
            ]);

            Route::get('/mraPrint', [
                'uses' => 'Phase1\mraController@getMRAprint',
                'name' => 'mraPrint'
            ]);

            Route::get('/generatemra', [
                'uses' => 'Phase1\mraController@generateMRA',
                'name' => 'generatemra'
            ]);

        /*Invoice Data Check*/
            Route::get('/invoicedatacheck', [
                'uses' => 'Phase1\InvoiceDataCheckController@getInvoiceDataCheck',
                'name' => 'invoicedatacheck'
            ]);

            Route::post('/readfile', [
                'uses' => 'Phase1\InvoiceDataCheckController@postReadfile',
                'name' => 'readfile'
            ]);

            Route::get('/varianceexcel', [
                'uses' => 'Phase1\InvoiceDataCheckController@varianceExcel',
                'name' => 'varianceexcel'
            ]);

            Route::get('/nonvariancecsv', [
                'uses' => 'Phase1\InvoiceDataCheckController@nonVarianceCSV',
                'name' => 'nonvariancecsv'
            ]);

            Route::get('/overdeliverypdf', [
                'uses' => 'Phase1\InvoiceDataCheckController@OverDeliveryPdf',
                'name' => 'overdeliverypdf'
            ]);

            Route::get('/unitcostexcel', [
                'uses' => 'Phase1\InvoiceDataCheckController@UnitCostExcel',
                'name' => 'unitcostexcel'
            ]);

             Route::get('/nonvarianceexcel', [
                'uses' => 'Phase1\InvoiceDataCheckController@nonVarianceExcel',
                'name' => 'nonvarianceexcel'
            ]);

        /*Order Data Check Controller*/
            Route::get('/orderdatacheck',[
                'uses' => 'Phase1\OrderDataCheckController@getOrderDataCheck',
                'name' => 'orderdatacheck'
            ]);

            Route::post('/readfiles',[
                'uses' => 'Phase1\OrderDataCheckController@postReadFiles',
                'name' => 'readfiles'
            ]);

            Route::post('/order_data_generate_report',[
                'uses' => 'Phase1\OrderDataCheckController@postOrderDataGenPDF',
                'name' => 'order_data_generate_report'
            ]);

            Route::post('/newproductpdf',[
                'uses' => 'Phase1\OrderDataCheckController@postNewProductPDF',
                'name' => 'newproductpdf'
            ]);

            Route::post('/readExcel',[
                'uses' => 'Phase1\OrderDataCheckController@postExcel',
                'name' => 'readExcel'
            ]);

            Route::get('/umPartDNexcel',[
                'uses' => 'Phase1\OrderDataCheckController@UnmatchPartsDN',
                'name' => 'umPartDNexcel'
            ]);

            Route::get('/umUnitexcel',[
                'uses' => 'Phase1\OrderDataCheckController@UnmatchUnitPrice',
                'name' => 'umUnitexcel'
            ]);

            Route::get('/umSalesexcel',[
                'uses' => 'Phase1\OrderDataCheckController@UnmatchSalePrice',
                'name' => 'umSalesexcel'
            ]);

            Route::get('/umBOMexcel',[
                'uses' => 'Phase1\OrderDataCheckController@UnmatchBOM',
                'name' => 'umBOMexcel'
            ]);

            Route::get('/umProdDNexcel',[
                'uses' => 'Phase1\OrderDataCheckController@UnmatchProdDN',
                'name' => 'umProdDNexcel'
            ]);

            Route::get('/umProdNameexcel',[
                'uses' => 'Phase1\OrderDataCheckController@UnmatchProdName',
                'name' => 'umProdNameexcel'
            ]);

            Route::get('/umPartNameexcel',[
                'uses' => 'Phase1\OrderDataCheckController@UnmatchPartName',
                'name' => 'umPartNameexcel'
            ]);

            Route::get('/umSuppexcel',[
                'uses' => 'Phase1\OrderDataCheckController@UnmatchSupplier',
                'name' => 'umSuppexcel'
            ]);

            Route::get('/umUsageexcel',[
                'uses' => 'Phase1\OrderDataCheckController@UnmatchUsage',
                'name' => 'umUsageexcel'
            ]);

            Route::get('/momscheck',[
                'uses' => 'Phase1\OrderDataCheckController@getMomsCheckExcel',
                'name' => 'momscheck'
            ]);

        /*YPICS R3 ORDER DATA REPORT Routes*/
            // Route::get('/orderdatareport', [
            //     'uses' => 'Phase1\OrderDataReportController@getOrderDataReport',
            //     'name' => 'orderdatareport'
            // ]);

            // Route::post('/connect-orderdatareport', [
            //     'uses' => 'Phase1\OrderDataReportController@postOrderDataReport',
            //     'name' => 'connect-orderdatareport'
            // ]);

            // Route::post('/print-orderdatareport', [
            //     'uses' => 'Phase1\OrderDataReportController@printOrderDataReport',
            //     'name' => 'print-orderdatareport'
            // ]);

            // Route::post('/mrpusers-orderdatareport', [
            //     'uses' => 'Phase1\OrderDataReportController@startStopUsingYpics',
            //     'name' => 'mrpusers-orderdatareport'
            // ]);

            Route::group(['prefix' => 'ypicsr3'], function() {
                Route::get('/', 'Phase1\OrderDataReportController@index')->middleware('auth','revalidate');
                Route::post('/connect-orderdatareport', [
                    'uses' => 'Phase1\OrderDataReportController@postOrderDataReport',
                    'name' => 'connect-orderdatareport'
                ]);
                Route::post('/print-orderdatareport', [
                    'uses' => 'Phase1\OrderDataReportController@printOrderDataReport',
                    'name' => 'print-orderdatareport'
                ]);
                Route::post('/mrpusers-orderdatareport', [
                    'uses' => 'Phase1\OrderDataReportController@startStopUsingYpics',
                    'name' => 'mrpusers-orderdatareport'
                ]);
                Route::get('/ypics-user-data', 'Phase1\OrderDataReportController@getYpicsUserData');
                Route::get('/ypicsr3datatable', 'Phase1\OrderDataReportController@getYPICSR3datatable');
            });


        /*MRP Calculation*/
            Route::get('/mrpcalculation', [
                'uses' => 'Phase1\MRPCalculationController@getMRP',
                'name' => 'mrpcalculation'
            ]);

            Route::post('/mrpreadfiles', [
                'uses' => 'Phase1\MRPCalculationController@postReadFiles',
                'name' => 'mrpreadfiles'
            ]);

            Route::get('/mrpexcel', [
                'uses' => 'Phase1\MRPCalculationController@exportMrpDataToExcel',
                'name' => 'mrpexcel'
            ]);

            // Route::get('/mrpexcel', [
            //     'uses' => 'Phase1\MRPCalculationController@exportMrpData',
            //     'name' => 'mrpexcel'
            // ]);

        /*PARTS REJECTION RATE SYSTEM*/
            Route::get('/partsrejectionrate', [
                'uses' => 'Phase1\PartsRejectionRateController@getPartsRejectionRate',
                'name' => 'partsrejectionrate'
            ]);

            Route::post('/prrs-save', [
                'uses' => 'Phase1\PartsRejectionRateController@postPartsRejectionRate',
                'name' => 'prrs-save'
            ]);

            Route::post('/prrs-export', [
                'uses' => 'Phase1\PartsRejectionRateController@exportPartsRejectionRate',
                'name' => 'prrs-export'
            ]);

            Route::post('/prrs-uploadfile', [
                'uses' => 'Phase1\PartsRejectionRateController@postPrrsUploadFile',
                'name' => 'prrs-uploadfile'
            ]);

        /*Material List*/
            Route::get('/materiallist', [
                'uses' => 'Phase1\MaterialListController@getIndex',
                'name' => 'materiallist'
            ]);


            Route::post('/material_list_pdf', [
                'uses' => 'Phase1\MaterialListController@postGenerateMaterialList',
                'name' => 'material_list_pdf'
            ]);

            Route::get('/material-list-header/{data}', function() {
                return view('pdf.material_list_header')->with(['data'=>$data]);
            });


    /**
     *-------------------------------------------------------------------------
     *  Routes for SSS
     * ------------------------------------------------------------------------
     */

        /*SSS - PO STATUS*/
            Route::get('/postatus', [
              'uses' => 'SSS\PoStatusController@getPoStatus',
              'name' => 'postatus'
              ]);

            Route::get('/postatusajax', [
              'uses' => 'SSS\PoStatusController@ajaxPOStatus',
              'name' => 'postatusajax'
              ]);

            Route::post('/postatus', [
              'uses' => 'SSS\PoStatusController@postPoStatus',
              'name' => 'postatus'
              ]);

            Route::get('/po_printing', [
              'uses' => 'SSS\PoStatusController@printToPdf',
              'name' => 'po_printing'
              ]);

            Route::post('/po_printing', [
              'uses' => 'SSS\PoStatusController@printToPdf',
              'name' => 'po_printing'
              ]);

        /*SSS - PO PARTS STATUS*/
            Route::get('/popartsstatus', [
              'uses' => 'SSS\PoPartsStatusController@getPoPartsStatus',
              'name' => 'popartsstatus'
              ]);

            Route::post('/print-popartstatus', [
              'uses' => 'SSS\PoPartsStatusController@postPrintPoPartsStatus',
              'name' => 'print-popartstatus'
              ]);

        /*SSS - PO ISOGI INPUT*/
            Route::get('/poisogiinput', [
              'uses' => 'SSS\PoIsoGiInputController@getPoIsoGiInput',
              'name' => 'poisogiinput'
            ]);

            Route::post('/post-poisogiinput', [
              'uses' => 'SSS\PoIsoGiInputController@getPoIsoGiInput',
              'name' => 'post-poisogiinput'
              ]);

            Route::post('/print-poisogiinput', [
              'uses' => 'SSS\PoIsoGiInputController@postPrintIsoStatus',
              'name' => 'print-poisogiinput'
            ]);

        /*SSS - PO CHANGE DELIVERY*/
            Route::get('/pochangedelivery', [
              'uses' => 'SSS\PoChangeDeliveryController@getPoChangeDelivery',
              'name' => 'pochangedelivery'
            ]);

            Route::post('/send-mail', [
              'uses' => 'SSS\PoChangeDeliveryController@sendMail',
              'name' => 'send-mail'
            ]);

        /*Delivery Warning*/
            Route::get('/deliverywarning', [
                'uses' => 'SSS\DeliveryWarningController@getDeliveryWarning',
                'name' => 'deliverywarning'
            ]);

            Route::get('/getalldeliverywarning', [
                'uses' => 'SSS\DeliveryWarningController@getAllDeliveryWarning',
                'name' => 'getalldeliverywarning'
            ]);

            Route::get('/deliverywarningload', [
                'uses' => 'SSS\DeliveryWarningController@getAllDeliveryWarning',
                'name' => 'deliverywarningload'
            ]);

            Route::get('/loadDeliveryWarningWithDate', [
                'uses' => 'SSS\DeliveryWarningController@loadDeliveryWarningWithDate',
                'name' => 'loadDeliveryWarningWithDate'
            ]);

            Route::post('/postDeliveryWarningExcel', [
                'uses' => 'SSS\DeliveryWarningController@postDeliveryWarningExcel',
                'name' => 'postDeliveryWarningExcel'
            ]);

            Route::post('/postDeliveryWarningPDF', [
                'uses' => 'SSS\DeliveryWarningController@postDeliveryWarningPDF',
                'name' => 'postDeliveryWarningPDF'
            ]);

        /*Answer Input Management*/

            Route::get('/answerinputmanagement', [
                'uses' => 'SSS\AnswerInputManagementController@getIndex',
                'name' => 'answerinputmanagement'
            ]);
            Route::get('/answerinputmanagementload', [
                'uses' => 'SSS\AnswerInputManagementController@getAllAnswerInputManagement',
                'name' => 'answerinputmanagementload'
            ]);

            Route::get('/answerinputmanagementloadwithexceptions', [
                'uses' => 'SSS\AnswerInputManagementController@answerinputmanagementloadwithexceptions',
                'name' => 'answerinputmanagementloadwithexceptions'
            ]);

            Route::post('/postanswerinputmanagementexcel', [
                'uses' => 'SSS\AnswerInputManagementController@postanswerinputmanagementexcel',
                'name' => 'postanswerinputmanagementexcel'
            ]);

        /*Sample Douji Input*/
            Route::get('/sampledoujiinput', [
                'uses' => 'SSS\SampleDoujiInputController@getIndex',
                'name' => 'sampledoujiinput'
            ]);
            Route::get('/sampledoujiinputload', [
                'uses' => 'SSS\SampleDoujiInputController@getAllSampleDoujiInput',
                'name' => 'sampledoujiinputload'
            ]);

            Route::post('/doujiexportexcel', [
                'uses' => 'SSS\SampleDoujiInputController@postDoujiExportExcel',
                'name' => 'doujiexportexcel'
            ]);

        /*Parts Status*/
            Route::get('/partsstatus', [
                'uses' => 'SSS\PartsStatusController@getPartsStatus',
                'name' => 'partsstatus'
            ]);

            Route::post('/postpartstatus', [
                'uses' => 'SSS\PartsStatusController@getPartsStatus',
                'name' => 'postpartstatus'
            ]);

            Route::post('/print-partstatus', [
              'uses' => 'SSS\PartsStatusController@postPrintPartsStatus',
              'name' => 'print-partstatus'
            ]);

        /*Data Update*/
            Route::get('/dataupdate', [
                'uses' => 'SSS\DataUpdateController@getDataUpdate',
                'name' => 'dataupdate'
            ]);

            Route::post('/partsanswer', [
                'uses' => 'SSS\DataUpdateController@postPartsAnswer',
                'name' => 'partsanswer'
            ]);

            Route::post('/mrp_and_r3answer', [
                'uses' => 'SSS\DataUpdateController@post_mrp_and_r3answer',
                'name' => 'mrp_and_r3answer'
            ]);

            Route::get('/getFileDate', [
                'uses' => 'SSS\DataUpdateController@getFileDate',
                'name' => 'getFileDate'
            ]);

        /*Answer Input*/
            Route::get('/answerinput', [
                'uses' => 'SSS\AnswerInputController@getAnswerInput',
                'name' => 'answerinput'
            ]);


/*-------------------------------------------------------------------/
*                 DO NOT PASTE YOUR ROUTES BEYOND THIS SECTION
* ------------------------------------------------------------------*/


    Route::get('/', 'Auth\AuthController@getLogin');

    //Route::auth();

    // Authentication Routes...
    //Route::get('login', 'Auth\AuthController@showLoginForm');
    Route::post('login', 'Auth\AuthController@login');
    Route::get('logout', 'Auth\AuthController@logout');

    // Registration Routes...
    //Route::get('register', 'Auth\AuthController@showRegistrationForm');
    //Route::post('register', 'Auth\AuthController@register');

    // Password Reset Routes...
    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');

    Route::get('/withdrawal-detail', 'YPICS\WithdrawalDetailController@index');
    Route::post('/xhiki-readfile', 'YPICS\WithdrawalDetailController@processExcelFile');
    Route::get('/xhiki-excel', 'YPICS\WithdrawalDetailController@downloadExcelFile');
    Route::get('/xhiki-checkdata', 'YPICS\WithdrawalDetailController@checkData');

    Route::get('/ypics-dispatch', 'YPICS\YPICSDispatchController@index');
    Route::post('/dispatch-readfile', 'YPICS\YPICSDispatchController@processExcelFile');
    Route::get('/dispatch-excel', 'YPICS\YPICSDispatchController@downloadExcelFile');
    Route::get('/dispatch-checkdata', 'YPICS\YPICSDispatchController@checkData');
    Route::get('/dispatch-datatable', 'YPICS\YPICSDispatchController@getDispatchData');

    // WBS Inventory
    Route::get('/wbs-inventory', 'WBS\WBSInventoryController@index');
    Route::get('/wbs-inventory-list', 'WBS\WBSInventoryController@inventory_list');
    Route::post('/wbs-inventory-delete', 'WBS\WBSInventoryController@deleteselected');
    Route::post('/wbs-inventory-save', 'WBS\WBSInventoryController@savedata');