<?php
if (isset($_POST['code'])) 
{ 
    $code = $_POST['code'];
    # Creating the array
    $data = array(
        'public' => 1,
        'files' => array(
            $_POST['project'].'.html' => array('content' => $code),
        ),
    );
    $data_string = json_encode($data);

    # Sending the data using cURL
    $url = 'https://api.github.com/gists';
    $ch = curl_init($url);
    curl_setopt($ch,CURLOPT_HTTPHEADER,array('User-Agent: Sand-App'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    # Parsing the response
    $decoded = json_decode($response, TRUE);
    $gistlink = $decoded['html_url'];

    echo $gistlink;
}
?>
