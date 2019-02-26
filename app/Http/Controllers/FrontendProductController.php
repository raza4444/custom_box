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
use App\WebmasterSetting;
use App\Topic;
use App\TopicCategory;
use App\User;
use App\Webmail;
use Mail;
use App\WebmasterSection;
use Illuminate\Http\Request;


class FrontendProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cat = 0)
    {

        //
       
        return $this->topicsByLang("", 'products', $cat);
    }

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
    public function requestForQuote(Request $request)
    {



        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'stock' => 'required',
            'box_style' => 'required',
            'color' => 'required',
            'type' => 'required',
            'length' => 'required',
            'width' => 'required',
            'height' => 'required',
            'unit' => 'required',
            'pid' => 'required',
            'qty' => 'required',

        ]);


        if (env('NOCAPTCHA_STATUS', false)) {
            $this->validate($request, [
                'g-recaptcha-response' => 'required|captcha'
            ]);
        }
        $WebsiteSettings = Setting::find(1);
        $site_title_var = "site_title_" . trans('backLang.boxCode');
        $site_email = $WebsiteSettings->site_webmails;
        $site_url = $WebsiteSettings->site_url;
        $site_title = $WebsiteSettings->$site_title_var;
        $Topic = Topic::where('status', 1)->find($request->pid);
        if (!empty($Topic)) {
           $tpc_title_var = "title_" . trans('backLang.boxCode');
           $tpc_title = $Topic->$tpc_title_var;


           $message_detail = $this->RFQTemplate($request);
           $Webmail = new Webmail;
           $Webmail->cat_id = 0;
           $Webmail->group_id = null;
           $Webmail->contact_id = null;
           $Webmail->father_id = null;
           $Webmail->title = "Request For Query (". $Topic->$tpc_title_var.')';
           $Webmail->details = $message_detail;
           $Webmail->date = date("Y-m-d H:i:s");
           $Webmail->from_email = $request->email;
           $Webmail->from_name = $request->name;
           $Webmail->from_phone = $request->phone;
           $Webmail->to_email = $WebsiteSettings->site_webmails;
           $Webmail->to_name = $WebsiteSettings->$site_title_var;
           $Webmail->status = 0;
           $Webmail->flag = 0;
           $Webmail->save();


           
           if ($WebsiteSettings->notify_orders_status) {
            if (env('MAIL_USERNAME') != "") {
                Mail::send('backEnd.emails.webmail', [
                    'title' => "NEW Query on :" . $tpc_title,
                    'details' => $message_detail,
                    'websiteURL' => $site_url,
                    'websiteName' => $site_title
                ], function ($message) use ($request, $site_email, $site_title, $tpc_title) {
                    $message->from(env('NO_REPLAY_EMAIL', $request->email), $request->name);
                    $message->to($site_email);
                    $message->replyTo($request->email, $site_title);
                    $message->subject("NEW Query on :" . $tpc_title);

                });
            }
        }

    }

    return back();
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
     return $this->topicByLang("", 'products', $id);
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
    public function topicByLang($lang = "", $section = 0, $id = 0)
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        // check for pages called by name not id
        


        // get Webmaster section settings by name
        $WebmasterSection = WebmasterSection::where('name', $section)->first();
        if (empty($WebmasterSection)) {
            // get Webmaster section settings by ID
            $WebmasterSection = WebmasterSection::find($section);
        }
        if (!empty($WebmasterSection)) {

            // count topics by Category
            $category_and_topics_count = array();
            $AllSections = Section::where('webmaster_id', '=', $WebmasterSection->id)->where('status', 1)->orderby('row_no', 'asc')->get();
            if (count($AllSections) > 0) {
                foreach ($AllSections as $AllSection) {
                    $category_topics = array();
                    $TopicCategories = TopicCategory::where('section_id', $AllSection->id)->get();
                    foreach ($TopicCategories as $category) {
                        $category_topics[] = $category->topic_id;
                    }

                    $Topics = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->whereIn('id', $category_topics)->orderby('row_no', 'asc')->get();
                    $category_and_topics_count[$AllSection->id] = count($Topics);
                }
            }

            $Topic = Topic::where('status', 1)->find($id);


            if (!empty($Topic) && ($Topic->expire_date == '' || ($Topic->expire_date != '' && $Topic->expire_date >= date("Y-m-d")))) {
                // update visits
                $Topic->visits = $Topic->visits + 1;
                $Topic->save();

                // Get current Category Section details
                $CurrentCategory = array();
                $TopicCategory = TopicCategory::where('topic_id', $Topic->id)->first();
                if (!empty($TopicCategory)) {
                    $CurrentCategory = Section::find($TopicCategory->section_id);
                }
                // Get a list of all Category ( for side bar )
                $Categories = Section::where('webmaster_id', '=', $WebmasterSection->id)->where('status',
                    1)->where('father_id', '=', '0')->orderby('row_no', 'asc')->get();

                // Get Most Viewed
                $TopicsMostViewed = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->orderby('visits', 'desc')->limit(3)->get();

                // General for all pages

                $WebsiteSettings = Setting::find(1);
                $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
                $FooterMenuLinks_name_ar = "";
                $FooterMenuLinks_name_en = "";
                if (!empty($FooterMenuLinks_father)) {
                    $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
                    $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
                }
                $SideBanners = Banner::where('section_id', $WebmasterSettings->side_banners_section_id)->where('status',
                    1)->orderby('row_no', 'asc')->get();

                // Get Latest News
                $LatestNews = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', null]])->orderby('row_no', 'asc')->limit(3)->get();

                // Page Title, Description, Keywords
                $seo_title_var = "seo_title_" . trans('backLang.boxCode');
                $seo_description_var = "seo_description_" . trans('backLang.boxCode');
                $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
                $tpc_title_var = "title_" . trans('backLang.boxCode');
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');
                if ($Topic->$seo_title_var != "") {
                    $PageTitle = $Topic->$seo_title_var;
                } else {
                    $PageTitle = $Topic->$tpc_title_var;
                }
                if ($Topic->$seo_description_var != "") {
                    $PageDescription = $Topic->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($Topic->$seo_keywords_var != "") {
                    $PageKeywords = $Topic->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }
                // .. end of .. Page Title, Description, Keywords

         $WebmasterSection = WebmasterSection::where('name', 'products')->first();
        $SearchCategories = Section::where('webmaster_id', '=', $WebmasterSection->id)->where('father_id', '=',
            '0')->where('status', 1)->orderby('row_no', 'asc')->get();   
                return view("frontEnd.pages.products.single-product",
                    compact("WebsiteSettings",
                        "WebmasterSettings",
                        "FooterMenuLinks_name_ar",
                        "FooterMenuLinks_name_en",
                        "LatestNews",
                        "Topic",
                        "SideBanners",
                        "WebmasterSection",
                        "Categories",
                        "CurrentCategory",
                        "PageTitle",
                        "PageDescription",
                        "PageKeywords",
                        "TopicsMostViewed",
                        "category_and_topics_count",
                        "SearchCategories"));

            } else {
                return redirect()->action('FrontendHomeController@HomePage');
            }
        } else {
            return redirect()->action('FrontendHomeController@HomePage');
        }
    }
    public function topicsByLang($lang = "", $section = 0, $cat = 0)
    {
        
        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);


        // get Webmaster section settings by name
        $WebmasterSection = WebmasterSection::where('name', $section)->first();
        if (empty($WebmasterSection)) {
            // get Webmaster section settings by ID
            $WebmasterSection = WebmasterSection::find($section);
        }
        if (!empty($WebmasterSection)) {

            // count topics by Category
            $category_and_topics_count = array();
            $AllSections = Section::where('webmaster_id', '=', $WebmasterSection->id)->where('status', 1)->orderby('row_no', 'asc')->get();
            if (count($AllSections) > 0) {
                foreach ($AllSections as $AllSection) {
                    $category_topics = array();
                    $TopicCategories = TopicCategory::where('section_id', $AllSection->id)->get();
                    foreach ($TopicCategories as $category) {
                        $category_topics[] = $category->topic_id;
                    }

                    $Topics = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->whereIn('id', $category_topics)->orderby('row_no', 'asc')->get();
                    $category_and_topics_count[$AllSection->id] = count($Topics);
                }
            }

            // Get current Category Section details
            $CurrentCategory = Section::find($cat);
            // Get a list of all Category ( for side bar )
            $Categories = Section::where('webmaster_id', '=', $WebmasterSection->id)->where('father_id', '=',
                '0')->where('status', 1)->orderby('row_no', 'asc')->get();
//asdasd
            if (!empty($CurrentCategory)) {
                $category_topics = array();
                $TopicCategories = TopicCategory::where('section_id', $cat)->get();
                foreach ($TopicCategories as $category) {
                    $category_topics[] = $category->topic_id;
                }
                // update visits
                $CurrentCategory->visits = $CurrentCategory->visits + 1;
                $CurrentCategory->save();
                // Topics by Cat_ID
                $Topics = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->whereIn('id', $category_topics)->orderby('row_no', 'asc')->paginate(env('FRONTEND_PAGINATION'));
                // Get Most Viewed Topics fot this Category
                $TopicsMostViewed = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->whereIn('id', $category_topics)->orderby('visits', 'desc')->limit(3)->get();
            } else {
                // Topics if NO Cat_ID
                $CurrentCategory = 'none';
                $Topics = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status',
                    1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->orderby('row_no', 'asc')->paginate(env('FRONTEND_PAGINATION'));
                // Get Most Viewed
                $TopicsMostViewed = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status',
                    1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->orderby('visits', 'desc')->limit(3)->get();
            }

            // General for all pages

            $WebsiteSettings = Setting::find(1);
            $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
            $FooterMenuLinks_name_ar = "";
            $FooterMenuLinks_name_en = "";
            if (!empty($FooterMenuLinks_father)) {
                $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
                $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
            }
            $SideBanners = Banner::where('section_id', $WebmasterSettings->side_banners_section_id)->where('status',
                1)->orderby('row_no', 'asc')->get();


            // Get Latest News
            $LatestNews = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', null]])->orderby('row_no', 'asc')->limit(3)->get();

            // Page Title, Description, Keywords
            $seo_title_var = "seo_title_" . trans('backLang.boxCode');
                $seo_description_var = "seo_description_" . trans('backLang.boxCode');
                $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
                $tpc_title_var = "title_" . trans('backLang.boxCode');
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');
             $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

                $PageTitle = trans('backLang.' . $WebmasterSection->name);
                $PageDescription = $WebsiteSettings->$site_desc_var;
                $PageKeywords = $WebsiteSettings->$site_keywords_var;
            // if (!empty($CurrentCategory)) {
                
            //     if ($CurrentCategory->$seo_title_var != "") {
            //         $PageTitle = $CurrentCategory->$seo_title_var;
            //     } else {
            //         $PageTitle = $CurrentCategory->$tpc_title_var;
            //     }
            //     if ($CurrentCategory->$seo_description_var != "") {
            //         $PageDescription = $CurrentCategory->$seo_description_var;
            //     } else {
            //         $PageDescription = $WebsiteSettings->$site_desc_var;
            //     }
            //     if ($CurrentCategory->$seo_keywords_var != "") {
            //         $PageKeywords = $CurrentCategory->$seo_keywords_var;
            //     } else {
            //         $PageKeywords = $WebsiteSettings->$site_keywords_var;
            //     }
            // } else {
               

            // }
            // .. end of .. Page Title, Description, Keywords
            //search category for header
        $WebmasterSection = WebmasterSection::where('name', 'products')->first();
        $SearchCategories = Section::where('webmaster_id', '=', $WebmasterSection->id)->where('father_id', '=',
            '0')->where('status', 1)->orderby('row_no', 'asc')->get();   


            //
            return view("frontEnd.pages.products.index",
                compact("WebsiteSettings",
                    "WebmasterSettings",
                    "FooterMenuLinks_name_ar",
                    "FooterMenuLinks_name_en",
                    "LatestNews",
                    "SideBanners",
                    "WebmasterSection",
                    "Categories",
                    "Topics",
                    "CurrentCategory",
                    "PageTitle",
                    "PageDescription",
                    "PageKeywords",
                    "TopicsMostViewed",
                    "category_and_topics_count",
                    "SearchCategories"));
            
        } else {

           // return $this->SEOByLang($lang, $section);
        }

    }

    public function RFQTemplate($data)
    {
       

        $html = '';
        $html .= 'Hi,';
        $html .= '<br></br>';
        $html .= 'I am interested in ordering a custom packaging for my product with the following details:';
        $html .= '<br>';
        $html .= '<b>Packege Name:</b>  '.' '.$data->box_style;
        $html .= '<br>';
        $html .= '<b>Type:</b>  '.' '.$data->type;
        $html .= '<br>';
        $html .= '<b>Stock:</b>  '.' '.$data->stock;
        $html .= '<br>';
        $html .= '<b>Box Style:</b>  '.' '.$data->box_style;
        $html .= '<br>';
        $html .= '<b>Color:</b>  '.' '.$data->color;
        $html .= '<br>';
        $html .= '<b>Length:</b>  '.' '.$data->length.' '.$data->unit;
        $html .= '<br>';
        $html .= '<b>Width:</b>  '.' '.$data->width.' '.$data->unit;
        $html .= '<br>';
        $html .= '<b>Height:</b>  '.' '.$data->height.' '.$data->unit;
        $html .= '<br>';
        $html .= '<b>Quantity:</b>  '.' '.$data->qty;
        $html .= '<br>';
        if($data->qty1 != '' || $data->qty1 != null)
        {
            $html .= '<b>Quantity2:</b>  '.' '.$data->qty1;
            $html .= '<br>';
        }
        if($data->qty2 != '' || $data->qty2 != null)
        {
            $html .= '<b>Quantity3:</b>  '.' '.$data->qty2;
            $html .= '<br>';
        }


        if(!isset($data->comment))
        {
//$url = route('routeName', ['id' => $data->pid]);
            $topic_link_url = route('FrontendProduct', ["id" => $data->pid]);
            $html .= '<br><br>';
            $html .= '<a href="'.$topic_link_url.'" style="wdith:100%; background-color: skyblue;
            padding: 9px;text-decoration: none;">View Selected Product</a>';
            $html .= '<br><br>';

        }
        $html .= 'I am looking forward for you reply.';
        $html .= '</br>';
        $html .= 'Best Regards';

 return $html;   # code...
}

//
    //end 
}
