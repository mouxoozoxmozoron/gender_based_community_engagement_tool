public function register(UserRegistrationRequest $request) {
        //Extracting data from custom request
        //$userData = $request->validated();
        $userData = $request->validated();
        Log::info('User Data:', $userData);


        //creating user by using static method create
       // $userData['password'] = Hash::make($userData['password']);


        //Get the file string from request
       // $photo_string = $request->input('cover_image');
        $photo_string = $userData['photo'];
        //Decoding the image string and storing it to the storage
        $profile_photo__url = $this->storeBase64File( $photo_string, 'Files/profile_photo');

        //Modifying post attributes
       // $post['user_id'] = Auth::user()->id;
       $userData['photo'] = $profile_photo__url;

      // dd($userData);

       $user = User::create($userData);

//      $user = new User();
// $user->UserName = $userData['UserName'];
// $user->email = $userData['email'];
// $user->Phone = $userData['Phone'];
// $user->password = Hash::make($userData['password']);
// $user->photo = $userData['photo'];

// $user->save();

        //Creating user token for authentication using sanctum
        $token = $user->createToken('user-token')->plainTextToken;

        return response()->json([
        'user' => $user,
        'token' => $token
        ], 201);


     }

     public function testing(Request $request){
        return response()->json([
            "message" => "THE CLASS IS RUNNING FINE"
        ], 200);
     }
