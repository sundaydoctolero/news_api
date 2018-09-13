<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Au extends Model
{
    protected $table = 'au';

    protected $fillable = ['Page_No','State','Publication_Name','Publication_Date','Unit_No','Street_No','Street_No_Suffix',
                            'Street_Name','Street_Extension','Suburb','City','Property_Type','Listing_Type','Price_From',
                            'Price_To','Price_Description','Rental_Period','Auction_Date','Auction_Time','Auction_Location','PostCode',
                            'Data_Entry_Date','Sale_Rent','Bedrooms','M2_Total_Floor','Land_Area','Land_Area_Metric',
                            'Ensuites','Toilets','Dining_Rooms','Lounge_Dining','Other_Rooms','Lockup_Garages','Year_Built',
                            'Floor_Level','No_Of_Floor','Bathrooms','Lounge_Rooms','No_Of_Study','No_Of_Tennis',
                            'Family_Rumpus','Car_Spaces','Year_Building','Total_Floors','Construction_Type','Materials_In_Roof',
                            'Type_Of_Scenic','Additional_Property','Water_Frontage','Scenic_View','Air_Conditioned','Heritage_Other','Lift_Installed',
                            'Access_Security','Close_To_Public','Vendor_Will_Trade','Permanent_Water','Mains_Electricity','River_Frontage',
                            'Coast_Frontage','Canal_Frontage','Lake_Frontage','Sealed_Roads','Open_Plan','Fireplace','Polished_Floors',
                            'Swimming_Pool','Renovated','Double_Storey','Ducted_Heating','Granny_Flat','Selling_Off','Boat_Ramp','Ducted_Vaccuum',
                            'Town_Water','Town_Sewerage','Curb_Chanelling','All_Weather_Access','Land_Subject','Phone_Service','Land_Can_Be',
                            'Trees_On_Land','Ad_Size','Ad_Photo_Type','Ad_Photo_Count','Ad_Section','Ad_Exclusive','Date_Creation'];

    public $timestamps = false;

    public function setWaterFrontageAttribute($value){
        if($value == true){
            return $this->attributes['Water_Frontage'] = "Y";
        } else {
            return $this->attributes['Water_Frontage'] = "";
        }
    }

    public function agents(){
        return $this->hasMany('App\Agent','au_id','id');
    }

}
