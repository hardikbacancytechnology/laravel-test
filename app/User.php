<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    public function listings($request){
        if(count($request->all())>0){
            $columns[] = 'id';
            $columns[] = 'name';
            $columns[] = 'email';
            $users = User::selectRaw(implode(',',$columns));
            if(isset($request->order[0]['column'])){
                $users->orderBy($columns[$request->order[0]['column']-1],$request->order[0]['dir']);
            }
            if(isset($request->start) and isset($request->length)){
                $users->take($request->length)->skip($request->start);    
            }
            if(isset($request->search['value']) and $request->search['value']){
                $users->where(function($query) use($request,$columns){
                    for($j=0;$j<count($columns);$j++){
                        if($j==0):
                            $query->where($columns[$j],'LIKE','%'.$request->search['value'].'%');
                        else:
                            $query->orWhere($columns[$j],'LIKE','%'.$request->search['value'].'%');
                        endif;
                    }
                });
            }
            $users = $users->get();
            $recordsTotal = User::selectRaw('COUNT(*) as count')->first()->count;
            $recordsFiltered = User::selectRaw('COUNT(*) as count');
            if(isset($request->search['value']) and $request->search['value']){
                $recordsFiltered->where(function($query) use($request,$columns){
                    for($j=0;$j<count($columns);$j++){
                        if($j==0):
                            $query->where($columns[$j],'LIKE','%'.$request->search['value'].'%');
                        else:
                            $query->orWhere($columns[$j],'LIKE','%'.$request->search['value'].'%');
                        endif;
                    }
                });
            }
            $recordsFiltered = $recordsFiltered->first()->count;
            $sOutput = '{
                "draw": '.$request->draw.',
                "recordsTotal": '.$recordsTotal.',
                "recordsFiltered": '.$recordsFiltered.',
                "data": [';
                foreach($users as $k => $user){
                    $sOutput .= '[';
                    $sOutput .= '"'.($k + 1 + $request->start).'",';
                    for($i=0;$i<count($columns);$i++){
                        $col = $columns[$i];
                        $primary_key = $columns[0];
                        $sOutput .= '"'.$this->checkEmail($user->$col).'",';
                    }
                    $sOutput .= '"<a href=\"'.route('users.edit',$user->$primary_key).'\" class=\"btn btn-primary btn-sm ajax_anchor\" title=\"Edit user\" data-toggle=\"tooltip\"><i class=\"fa fa-edit\"></i></a>'.(($user->$primary_key!=\Auth::user()->id) ? ' | <a href=\"javascript:;\" class=\"btn btn-danger btn-sm confirm-delete\" data-module=\"users\" data-id=\"'.$user->$primary_key.'\" title=\"Delete user\" data-toggle=\"tooltip\"><i class=\"fa fa-trash\"></i></a>' : '').'"';
                    $sOutput .= '],';
                }
                $sOutput = rtrim($sOutput,',');
                $sOutput .= ']
            }';
            die($sOutput);
        }
    }
    private function checkEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return '<a href=\"mailto:'.$email.'\">'.$email.'</a>';
        }else{
            return $email;
        }
    }
}