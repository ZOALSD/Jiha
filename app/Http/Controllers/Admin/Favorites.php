<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\FavoritesDataTable;
use Carbon\Carbon;
use App\Models\Favorite;

use App\Http\Controllers\Validations\FavoritesRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Favorites extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:favorites_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:favorites_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:favorites_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:favorites_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [it v 1.6.40]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(FavoritesDataTable $favorites)
            {
               return $favorites->render('admin.favorites.index',['title'=>trans('admin.favorites')]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.favorites.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(FavoritesRequest $request)
            {
                $data = $request->except("_token", "_method");
            			  		$favorites = Favorite::create($data); 
                $redirect = isset($request["add_back"])?"/create":"";
                return redirectWithSuccess(aurl('favorites'.$redirect), trans('admin.added')); }

            /**
             * Display the specified resource.
             * Baboon Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		$favorites =  Favorite::find($id);
        		return is_null($favorites) || empty($favorites)?
        		backWithError(trans("admin.undefinedRecord"),aurl("favorites")) :
        		view('admin.favorites.show',[
				    'title'=>trans('admin.show'),
					'favorites'=>$favorites
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		$favorites =  Favorite::find($id);
        		return is_null($favorites) || empty($favorites)?
        		backWithError(trans("admin.undefinedRecord"),aurl("favorites")) :
        		view('admin.favorites.edit',[
				  'title'=>trans('admin.edit'),
				  'favorites'=>$favorites
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
            public function updateFillableColumns() {
				$fillableCols = [];
				foreach (array_keys((new FavoritesRequest)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(FavoritesRequest $request,$id)
            {
              // Check Record Exists
              $favorites =  Favorite::find($id);
              if(is_null($favorites) || empty($favorites)){
              	return backWithError(trans("admin.undefinedRecord"),aurl("favorites"));
              }
              $data = $this->updateFillableColumns(); 
              Favorite::where('id',$id)->update($data);
              $redirect = isset($request["save_back"])?"/".$id."/edit":"";
              return redirectWithSuccess(aurl('favorites'.$redirect), trans('admin.updated'));
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$favorites = Favorite::find($id);
		if(is_null($favorites) || empty($favorites)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("favorites"));
		}
               
		it()->delete('favorite',$id);
		$favorites->delete();
		return redirectWithSuccess(aurl("favorites"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$favorites = Favorite::find($id);
				if(is_null($favorites) || empty($favorites)){
					return backWithError(trans('admin.undefinedRecord'),aurl("favorites"));
				}
                    	
				it()->delete('favorite',$id);
				$favorites->delete();
			}
			return redirectWithSuccess(aurl("favorites"),trans('admin.deleted'));
		}else {
			$favorites = Favorite::find($data);
			if(is_null($favorites) || empty($favorites)){
				return backWithError(trans('admin.undefinedRecord'),aurl("favorites"));
			}
                    
			it()->delete('favorite',$data);
			$favorites->delete();
			return redirectWithSuccess(aurl("favorites"),trans('admin.deleted'));
		}
	}
            

}