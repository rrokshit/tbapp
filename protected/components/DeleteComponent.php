<?php
	class DeleteComponent extends CApplicationComponent
	{
		public $isPossible="";
		public function init() {
			// Init this component
			// $this->someconfig is already available
		}

		public function isDeletePossible($controller, $id) {
			$result="";
			switch(strtolower($controller)){
				case "hotelmaster":
						if(Entries::model()->exists('hotel_id_fk=:hotel_id_fk',array(':hotel_id_fk'=>$id))){
							$result.="* You can not delete this hotel because it is used in Entry. First delete Entry that is using it.\n";
						}
					break;
				case "guidemaster":
						if(SitescreenServiceGuides::model()->exists('guide_id_fk=:guide_id_fk',array(':guide_id_fk'=>$id))){
							$result.="* You can not delete this guide because it is used in Sightseen. First delete Sightseen that is using it.\n";
						}
					break;
				case "trainmaster":
						if(Arrival::model()->exists('train_id_fk=:train_id_fk',array(':train_id_fk'=>$id))){
							$result.="* You can not delete this train because it is used in Arrival. First delete Arrival that is using it.\n";
						}
						if(Departure::model()->exists('train_id_fk=:train_id_fk',array(':train_id_fk'=>$id))){
							$result.="* You can not delete this train because it is used in Departure. First delete Departure that is using it. \n";
						}
					break;
				case "busmaster":
						if(Arrival::model()->exists('bus_id_fk=:bus_id_fk',array(':bus_id_fk'=>$id))){
							$result.="* You can not delete this bus because it is used in Arrival, First delete Arrival that is using it. \n";
						}
						if(Departure::model()->exists('bus_id_fk=:bus_id_fk',array(':bus_id_fk'=>$id))){
							$result.="* You can not delete this bus because it is used in Departure. First delete Departure that is using it. \n";
						}
					break;
				case "flightmaster":
						if(Arrival::model()->exists('flight_id_fk=:flight_id_fk',array(':flight_id_fk'=>$id))){
							$result.="* You can not delete this flight because it is used in Arrival. First delete Arrival that is using it. \n";
						}
						if(Departure::model()->exists('flight_id_fk=:flight_id_fk',array(':flight_id_fk'=>$id))){
							$result.="* You can not delete this flight because it is used in Departure. First delete Departure that is using it. \n";
						}
					break;
				case "vehiclemaster":
						if(ArrivalVehicle::model()->exists('vehicle_id_fk=:vehicle_id_fk',array(':vehicle_id_fk'=>$id))){
							$result.="* You can not delete this vehicle because it is used in Arrival. First delete Arrival that is using it. \n";
						}
						if(SiteseenServiceVehicles::model()->exists('vehicle_id_fk=:vehicle_id_fk',array(':vehicle_id_fk'=>$id))){
							$result.="* You can not delete this vehicle because it is used in Sightseen. First delete Sightseen that is using it.\n";
						}
						if(Departurevehicle::model()->exists('vehicle_id_fk=:vehicle_id_fk',array(':vehicle_id_fk'=>$id))){
							$result.="* You can not delete this vehicle because it is used in Departure. First delete Departure that is using it. \n";
						}
					break;
				case "driveremaster":
						if(ArrivalVehicle::model()->exists('driver_id_fk=:driver_id_fk',array(':driver_id_fk'=>$id))){
							$result.="* You can not delete this driver because it is used in Arrival. First delete Arrival that is using it. \n";
						}
						if(SiteseenServiceVehicles::model()->exists('driver_id_fk=:driver_id_fk',array(':driver_id_fk'=>$id))){
							$result.="* You can not delete this driver because it is used in Sightseen. First delete Sightseen that is using it.\n";
						}
						if(Departurevehicle::model()->exists('driver_id_fk=:driver_id_fk',array(':driver_id_fk'=>$id))){
							$result.="* You can not delete this driver because it is used in Departure. First delete Departure that is using it. \n";
						}
					break;
				
			}
			$this->isPossible=$result;
		}
	}
?>