<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $output = '';

        $validator = Validator::make($request->all(), [
            'term' => 'required|string|between:2,50|regex:/(^([a-zA-z0-9 ]+)(\d+)?$)/u',
        ]);

        $validator->stopOnFirstFailure(true);

        if ($validator->fails()) {

            $output = '<div><span class="ml-2 mb-2 badge badge-danger"> The term format is invalid. </span></div>';
        } else {
            $services = Service::select('title', 'slug')->where('title', 'like', '%' . $request->term . '%')->orderBy('updated_at', 'DESC')->take(5)->get();
            $faqs = Faq::select('question')->where('question', 'like', '%' . $request->term . '%')->orderBy('updated_at', 'DESC')->take(5)->get();

            if ($services) {
                foreach ($services as $key => $service) {
                    $service_result = explode('|', $service->title);
                    $output .= '<div><a href="' . url('service/' . $service->slug) . '">' . $service_result[0] . '</a><span style="margin-left:8px" class="ml-2 badge bg-primary">Services</span></div>';
                }
            }
            if ($faqs) {
                foreach ($faqs as $key => $faq) {
                    $faq_result = explode('|', $faq->question);
                    $output .= '<div><a href="' . url('faq') . '">' . $faq_result[0] . '</a><span style="margin-left:8px" class="ml-2 badge bg-secondary">Faqs</span></div>';
                }
            }
        }

        if ($output) {
            return Response('<div class="data">' . $output . '</div>');
        } else {
            return Response('<div class="data">There are no results that match your search</div>');
        }
    }
}
