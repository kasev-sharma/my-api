<?

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyValidation extends Validation{

    public function addFormValidation(Request $request){

        $validator = Validator::make($request->all(), [
            'site_name' => 'nullable|required|string|max:255',
            'ups_rating' => 'nullable|integer',
            'battery_bank' => 'nullable',
            'battery_capacity' => 'nullable|integer',
            'pg_gland' => 'nullable|integer',
            'thumbal' => 'nullable|integer',
            'nut_bolts' => 'nullable|integer',
            'farsher_quality' => 'nullable|integer',
            'battery_to_braker_cable' => 'nullable|integer', 
            'braker_to_ups' => 'nullable|integer',
            'control_cable' => 'nullable|integer',
            'ups_to_pannel_cable' => 'nullable|integer',
            'images' => 'nullable|array', // Images can be optional
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image formats
        ]);

        if ($validator->fails()) {
            return false;
        }
    } 
}