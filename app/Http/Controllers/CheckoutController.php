<?php

namespace App\Http\Controllers;

use App;
use App\Banner;
use App\Comment;
use App\Contact;
use App\Http\Requests;
use App\Menu;
use App\Section;
use App\Setting;
use App\Topic;
use App\TopicCategory;
use App\User;
use App\Webmail;
use App\WebmasterSection;
use App\WebmasterSetting;
use Illuminate\Http\Request;
use Mail;
use App\Services\CountriesService;
class CheckoutController extends Controller
{
    private $countries;
    public function __construct(CountriesService $countries)
    {

        $this->countries = $countries;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //general setting
        $WebsiteSettings = Setting::find(1);
        $PageTitle = ""; // will show default site Title
        
        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

        $PageDescription = $WebsiteSettings->$site_desc_var;
        $PageKeywords = $WebsiteSettings->$site_keywords_var;
         // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);
        // General for all pages
        $WebsiteSettings = Setting::find(1);
        $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
        $FooterMenuLinks_name_ar = "";
        $FooterMenuLinks_name_en = "";
        if (!empty($FooterMenuLinks_father)) {
            $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
            $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
        }
        // Get Home page slider banners
        $SliderBanners = Banner::where('section_id', $WebmasterSettings->home_banners_section_id)->where('status',
            1)->orderby('row_no', 'asc')->get();
        $WebmasterSection = WebmasterSection::where('name', 'products')->first();

        $SearchCategories = Section::where('webmaster_id', '=', $WebmasterSection->id)->where('father_id', '=',
            '0')->where('status', 1)->orderby('row_no', 'asc')->get(); 



        $BottomBanners = Banner::where('section_id', $WebmasterSettings->side_banners_section_id)->where('status',
            1)->orderby('row_no', 'asc')->get();
        //get latest product 

    //get checkout detail


        $WebmasterSection = WebmasterSection::where('name', 'checkout')->first();
         if (empty($WebmasterSection)) {
            // get Webmaster section settings by ID
            $WebmasterSection = WebmasterSection::find('checkout');
        }
        if (!empty($WebmasterSection))
        {
            $topic_id = $id;
            $Topic = Topic::where('status', 1)->find($id);
            if (!empty($Topic) && ($Topic->expire_date == '' || ($Topic->expire_date != '' && $Topic->expire_date >= date("Y-m-d")))) {
        $countries = $this->countries->countriesArray();
       
            return view("frontEnd.pages.checkout.index",
            compact("PageTitle",
               "PageDescription",
               "PageKeywords",
               "WebmasterSettings",
               "SliderBanners",
               "WebsiteSettings",
               "FooterMenuLinks_name_ar",
               "FooterMenuLinks_name_en",
               "WebsiteSettings",
               "WebmasterSection",
               "BottomBanners",
               "SearchCategories",
                "Topic",
                "topic_id",
                "countries"));
    

            }
            else
            {
                return redirect('404');   
                }        


     }
    
        

    }
    //    
        

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
