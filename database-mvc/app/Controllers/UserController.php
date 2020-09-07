<?php


namespace ITI\Controllers;
use ITI\Models\User;
use ITI\Lib\View;

class UserController
{
    private $id=null;
    private $name;
    private $email;
    private $password;
    private $extra;
    private $room_id;
    private $avatar=AVATAR;
    private $user;
    private $files=null;
    private $data=[];
    private $response=['status'=>FAIL,'message'=>[],'type'=>_FAIL];


    public function __construct($START_APP,$data=null,$files=null)
    {
        $this->user=new User(null,$START_APP);
        if ($data){
            $this->data=$data;
        }
        if ($files){
            $this->files=$files;
        }

    }
    public function setValues($data=null,$files=null){
        if ($data){
            $this->data=$data;
        }
        if ($files){
            $this->files=$files;
        }
    }
    public function index(){
        $users=$this->user->all();
        $rooms=[
            1=>'Room 1',
            2=>'Room 2',
            3=>'Room 3'
        ];
        $data['users']=$users;
        $data['rooms']=$rooms;
        View::render($this->user->viewDir,'index',$data);
    }
    public function store(){
        $this->validate();
        if (count($this->response['message'])>0){
            $this->response['status']=FAIL;
        }else{
            $this->response['status']=SUCCESS;
        }
        if ($this->response['status']===FAIL){
            // redirect back
            $_SESSION['response']=$this->response;
            $_SESSION['old']=$this->data['post'];
            redirect('index.php?controller=user&action=index');
        }else{
            $response=$this->user->insert([
                'name'=>$this->name,
                'email'=>$this->email,
                'room_id'=>$this->room_id,
                'extra'=>$this->extra,
                'avatar'=>$this->avatar,
                'password'=>$this->password
            ]);
            if ($response){
                $this->response['status']=SUCCESS;
                $this->response['type']=_SUCCESS;
                array_push($this->response['message'],'Success Operation');
                //return redirect back
                $_SESSION['response']=$this->response;
                unset($_SESSION['old']);
                redirect('index.php?controller=user&action=index');
            }else{
                array_push($this->response['message'],'Failed Operation');
                //return redirect back
                $_SESSION['response']=$this->response;
                redirect('index.php?controller=user&action=index');
            }
        }
    }
    public function edit(){
        $this->id=$this->data['get']['id'];
        $user=$this->user->getByPk($this->id);
        if (!$user){
            array_push($this->response['message'],'Not Found');
            $_SESSION['response']=$this->response;
            redirect('index.php?controller=user&action=index');
        }else{
            $users=$this->user->all();
            $rooms=[
                1=>'Room 1',
                2=>'Room 2',
                3=>'Room 3'
            ];

            $data['users']=$users;
            $data['currentUser']=$user;
            $data['rooms']=$rooms;
//            var_dump($data['currentUser']);
            View::render($this->user->viewDir,'index',$data);
        }

    }
    public function update(){

        $this->id=$this->data['post']['id'];
        $user=$this->user->getByPk($this->id);
        if (!$user){
            array_push($this->response['message'],'Not Found');
            $_SESSION['response']=$this->response;
            redirect('index.php?controller=user&action=index');
        }else{
            $this->validate('update',$user);

            if (count($this->response['message'])>0){
                $this->response['status']=FAIL;
            }else{
                $this->response['status']=SUCCESS;
            }
            if ($this->response['status']===FAIL){
                // redirect back
                $_SESSION['response']=$this->response;
                $_SESSION['old']=$this->data['post'];
                redirect('index.php?controller=user&action=index');
            }else{
                $response=$this->user->update($this->id,[
                    'name'=>$this->name,
                    'email'=>$this->email,
                    'room_id'=>$this->room_id,
                    'extra'=>$this->extra,
                    'avatar'=>$this->avatar,
                    'password'=>$this->password
                ]);
                if ($response){
                    $this->response['status']=SUCCESS;
                    $this->response['type']=_SUCCESS;
                    array_push($this->response['message'],'Success Operation');
                    $_SESSION['response']=$this->response;
                    unset($_SESSION['old']);
                    redirect('index.php?controller=user&action=index');
                }else{
                    array_push($this->response['message'],'Failed Operation');
                    //return redirect back
                    $_SESSION['response']=$this->response;
                    redirect('index.php?controller=user&action=index');
                }
            }

        }
    }
    public function destroy(){
        $this->id=$this->data['post']['id'];
        $user=$this->user->getByPk($this->id);
        if (!$user){
            array_push($this->response['message'],'Not Found');
        }else{
            if (!($user->avatar===AVATAR)){
                unlink(UPLOAD_PATH.DS.$user->avatar);
            }
            if ($this->user->delete($this->id)){
                $this->response['status']=SUCCESS;
                $this->response['type']=_SUCCESS;
                array_push($this->response['message'],'Success Operation');
                $_SESSION['response']=$this->response;
                redirect('index.php?controller=user&action=index');
            }else{
                $this->response['status']=FAIL;
                $this->response['type']=_FAIL;
                array_push($this->response['message'],'Failed Operation');
                $_SESSION['response']=$this->response;
                redirect('index.php?controller=user&action=index');
            }
        }

    }
    private function validate($method=null,$otherData=null){
        //validate name
        $validatedName=validateString($this->data['post']['name']);
        if ($validatedName===false){
            array_push($this->response['message'],'Name is required and not be empty');
        }else{
            $this->name=$validatedName;
        }
        //validate email
        $validatedEmail=validateEmail($this->data['post']['email']);
        if ($validatedEmail===false){
            array_push($this->response['message'],'Email is required and not be empty and must be in standard');
        }else{
            $result=isExist($this->user,'email',$validatedEmail,$otherData->email);
            if (is_array($result)){
                if ($result[0]>0){
                    array_push($this->response['message'],'Email is already exist');
                }else{
                    $this->email=$validatedEmail;
                }
            }else{
                if ($result===true){
                    array_push($this->response['message'],'Email is already exist');
                }else{
                    $this->email=$validatedEmail;
                }
            }

        }

        //validate password
        if ($method==='update' and empty($this->data['post']['password'])){
            $this->password=$otherData->password;
        }else{
        $validatedPassword=$this->validatePassword($this->data['post']['password']);
        if ($validatedPassword!==false){
            $confirmedvalidatedPassword=$this->validatePassword($this->data['post']['passwordConfirmation']);
            if ($confirmedvalidatedPassword===$validatedPassword){
                $this->password=generateStrongPassword($validatedPassword);
            }else{
                array_push($this->response['message'],'Invalid in password confirmation');
            }
        }
        }
        //validate extra
        $validatedExtra=validateString($this->data['post']['extra']);
        if ($validatedExtra===false){
            array_push($this->response['message'],'Extra is required and not be empty');
        }else{
            $this->extra=$validatedExtra;
        }
        //validate room
        $validatedRoom=validateInteger($this->data['post']['room_id']);
        if ($validatedRoom===false){
            array_push($this->response['message'],'Room is required and not be empty');
        }else{
            $this->room_id=$validatedRoom;
//            if (isExist($this->user,'room_id',$validatedRoom)){
//                $this->room_id=$validatedRoom;
//            }else{
//                array_push($this->response['message'],'Invalid Room');
//            }
        }



        //validate image
        if ($method==='update' and empty($this->files['avatar']['name'])){
            $this->avatar=$otherData->avatar;
        }else{
            if (!($otherData->avatar===AVATAR)){
                unlink(UPLOAD_PATH.DS.$otherData->avatar);
            }
            $this->validateFile($this->files);
        }

    }
    private function uploadFile($source,$destination){
        move_uploaded_file($source,UPLOAD_PATH.DS.$destination);
    }
    private function validateFile($file){
        //return source and destination if ok
        if (isset($file['avatar']) and $file['avatar']['size']!=0){
            $allowedFiles=['png','jpg','jpeg'];
            $extension=explode('.',$file['avatar']['name']);
            $extension=end($extension);
            if (in_array($extension,$allowedFiles)){
                $source=$file['avatar']['tmp_name'];
                $destination=uniqid('user_avatar_').time().'.'.$extension;
                $this->avatar=$destination;
                $this->uploadFile($source,$destination);
            }else{
                array_push($this->response['message'],'Invalid Image');
            }
        }
//        else{
//            $this->response['status']=SUCCESS;
//            $this->response['type']=_SUCCESS;
//        }
}
    private function validatePassword($password){
       if (validateString($password)===false){
           array_push($this->response['message'],'Password is required and not be empty');
           return false;
       }else{
           if (strlen($password)<8){
               array_push($this->response['message'],'Password must be at least 8 characters');
               return false;
           }else{
               return $password;
           }
       }
    }
}