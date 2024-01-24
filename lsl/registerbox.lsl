// Second Life Object Script
string url = "http://shadlandprojects.com/register.php"; // Your PHP script URL
key userKey; // Global variable to store the user's UUID

default {
    touch_start(integer total_number) {
        userKey = llDetectedKey(0); // Store the user's UUID
        string username = llKey2Name(userKey);
        llHTTPRequest(url, [HTTP_METHOD, "POST", HTTP_MIMETYPE, "application/x-www-form-urlencoded"], "username=" + llEscapeURL(username));
    }

    http_response(key request_id, integer status, list metadata, string body) {
        if (status == 200) {
            llInstantMessage(userKey, body); // Send the response back to the user using the stored UUID
        }
    }
}
