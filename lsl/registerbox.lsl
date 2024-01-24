string url = "http://shadlandprojects.com/register.php"; // Your PHP script URL
key userUUID; // Global variable to store the user's UUID

default {
    touch_start(integer total_number) {
        userUUID = llDetectedKey(0);
        string username = llKey2Name(userUUID);
        string uuid = (string)userUUID;
        llHTTPRequest(url, [HTTP_METHOD, "POST", HTTP_MIMETYPE, "application/x-www-form-urlencoded"], 
                      "username=" + llEscapeURL(username) + "&uuid=" + uuid);
    }

    http_response(key request_id, integer status, list metadata, string body) {
        if (status == 200) {
            llInstantMessage(userUUID, body); // Send the response back to the user using the stored UUID
        }
    }
}
