
    <?php
    $this->renderPartial($arrival_view, array(
        'arrivalDataProvider' => $arrivalDataProvider,
        'sdate' => $_POST['sdate'],
        'edate' => $_POST['edate'],
    ));
    ?>
    
    <?php
    $this->renderPartial($departure_view, array(
        'departureDataProvider' => $departureDataProvider,
        'sdate' => $_POST['sdate'],
        'edate' => $_POST['edate'],
    ));
    ?>
    
    <?php
    $this->renderPartial($sightseen_view, array(
        'sightseenDataProvider' => $sightseenDataProvider,
        'sdate' => $_POST['sdate'],
        'edate' => $_POST['edate'],
    ));
    ?>
