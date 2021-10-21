<?php


function getJWTFromRequest($authenticationHeader):string{
    if(is_null($authenticationHeader)){
        throw new Exception('El token es invalido!!');
    }
    
    return explode(' ',$authenticationHeader)[1];
}

function validateJWTFromRequest(string $encodeToken){
    $key = \Config\Services::getSecretKey();
    $decodedToken = \Firebase\JWT\JWT::decode($encodeToken, $key, ['HS256']);
    $userModel =new  \App\Models\UserModel();
    $userModel->findUserByEmailAddress($decodedToken->email);
}

function getSignedJWTForUser(string $email):string{
    $issuedAtTime = time();
    $tokenTimeToLive = getenv('JWT_TIME_TO_LIVE');
    $tokenExpiration = $issuedAtTime +$tokenTimeToLive;

    $payload = [
        'email'=>$email,
        'iat'=>$issuedAtTime,
        'exp'=>$tokenExpiration
    ];

    $jwt = \Firebase\JWT\JWT::encode($payload, \Config\Services::getSecretKey());
    return $jwt;
}