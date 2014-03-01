<?php
$this->layout = "travel_layout_content";
?>
<table width="100%">
    <tr>
        <td align="left">
            <img src="/images/logo.gif">
        </td>
        <td>
            <table align="right">
                <tr>
                    <td align="right">Head Office:Near The Gateway Hotel<br/>
                        (Formerly Hotel Taj View)<br/>
                        Fatehabad Road, AGRA - 282001</td>
                </tr>
                <tr>
                    <td>Tel.: +91 - 0562 - 2330230, 2330245</td>
                </tr>
                <tr>
                    <td>Fax : +91 - 0562 - 2330206, 2331219</td>
                </tr>
                <tr>
                    <td align="right">Email : travelbureau@airtelmall.in</td>
                </tr>
                <tr>
                    <td align="right">www.travelbureauindia.com</td>
                </tr>
            </table>
        </td>

    </tr>
</table>

<br/>
<table style="width: 100%">
    <tr>
        <td align="center"><span style="border: 2px solid #000; padding: 3px;">Entries-</span></td>
    </tr>
</table>
<br/>
<br>
<div style="font-weight: bold; border-top: 1px solid black; border-bottom: 1px solid black; padding: 3px 0px 3px 0px;">
    Hotel Booking Detail
</div>
<table width="100%">
    <tr><td>
    <table align="left">
        <tr>
            <td>Pnr Number: <?php echo $model->pnr_no?></td>
        </tr>
        <tr>
            <td>Arrival Date: <?php echo date("d-m-Y",strtotime($model->arrival_date))?></td>
        </tr>
        <tr>
            <td>Select Branch: <?php //echo $model->pnr_no?></td>
        </tr>
        <tr>
            <td>Entry By: <?php echo $model->staffIdFk->name?></td>
        </tr>
    </table>
    <table align="right">
        <tr>
            <td>Agency: <?php echo $model->agencyIdFk->name?></td>
        </tr>
        <tr>
            <td>City: <?php echo $model->agencyIdFk->city?></td>
        </tr>
        <tr>
            <td>Client Name: <?php echo $model->client_name?></td>
        </tr>
    </table>
        </td></tr>					
</table>
<br/>

<div style="font-weight: bold; border-top: 1px solid black; border-bottom: 1px solid black; padding: 3px 0px 3px 0px;">
    Total Forginer
</div>
<table width="100%">
    <tr>
    <table align="left">
        <tr>
            <td>Number Of Adults: <?php echo $model->foreigner_adult?></td>
        </tr>
    </table>
    <table align="right">
        <tr>
            <td>Number Of Childs: <?php echo $model->foreigner_child?></td>
        </tr>
    </table>
</tr>					
</table>
<br/>
<br/>

<div style="font-weight: bold; border-top: 1px solid black; border-bottom: 1px solid black; padding: 3px 0px 3px 0px;">
    Totel Indian 
</div>
<table width="100%">
    <tr>
    <table align="left">
        <tr>
            <td>Number Of Adult: <?php echo $model->indian_adult?></td>
        </tr>
        <tr>
            <td>Number Of Child: <?php echo $model->indian_child?></td>
        </tr>
        <tr>
            <td>Total No. PAX: <?php echo (int) $model->foreigner_adult+ (int) $model->foreigner_child + (int) $model->indian_adult + (int) $model->indian_child;?></td>
        </tr>
        <tr>
            <td>Hotel Required: <?php echo $model->hotel_required?></td>
        </tr>
        <tr>
            <td>Same Day: <?php echo $model->same_day?></td>
        </tr>
        <tr>
            <td>Asst. On Arrival: <?php echo $model->assistance_on_arrival?></td>
        </tr>
        <tr>
            <td>Asst. On Departure: <?php echo $model->asstDep?></td>
        </tr>
    </table>
    <table align="right">
        <tr>
            <td>Hotel Provider (TB): <?php echo $model->htlProvider?></td>
        </tr>
        <tr>
            <td>Bill Required: <?php echo $model->billReq?></td>
        </tr>
        <tr>
            <td> Tour Reference No: <?php echo $model->tour_reference_no?></td>
        </tr>
        <tr>
            <td>Exc Oder No: <?php echo $model->order_no?></td>
        </tr>
        <tr>
            <td>Exc Oder Date: <?php echo date("d-m-Y",strtotime($model->order_date))?></td>
        </tr>
        <tr>
            <td>Remarks: <?php echo $model->remarks?></td>
        </tr>
    </table>
</tr>					
</table>
