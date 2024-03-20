<?php
require 'vendor/autoload.php'; // "composer install"

use MongoDB\Client as MongoClient;

$client = new MongoClient("APIKEY");
$db = $client->vnest_database;
$collection = $db->applications;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = array(
        "business_name" => $_POST['bname'],
        "cin" => $_POST['cin'],
        "incorporation_date" => $_POST['inc'],
        "pan" => $_POST['pan'],
        "tan" => $_POST['tan'],
        "gst" => $_POST['gst'],
        "directors" => array(
            $_POST['1'],
            $_POST['2'],
            $_POST['3'],
            $_POST['4']
        ),
        "lead_enterpreneur" => array(
            "title" => $_POST['title'],
            "full_name" => $_POST['name'],
            "age" => $_POST['lage'],
            "mobile_number" => $_POST['mobno'],
            "email" => $_POST['Email'],
            "linkedin" => $_POST['linkedin']
        ),
        "address" => array(
            "city" => $_POST['city'],
            "state" => $_POST['state'],
            "postal_code" => $_POST['code'],
            "country" => $_POST['country']
        ),
        "resume" => $_FILES['cv']['name'],
        "qualification" => array(
            "highest_qualification" => $_POST['qual'],
            "year_of_passing" => $_POST['yr'],
            "area_of_specialization" => $_POST['area'],
            "research_experience" => $_POST['research']
        ),
        "business_details" => array(
            "type_of_business" => $_POST['type'],
            "business_plan" => $_FILES['plan']['name'],
            "time_in_business" => $_POST['timeinbusiness'],
            "services_required" => $_POST['services_required'],
            "team_details" => array(
                "full_time" => $_POST['full'],
                "part_time" => $_POST['part'],
                "consultants" => $_POST['consultants']
            ),
            "team_members" => array(
                array(
                    "full_name" => $_POST['name1'],
                    "age" => $_POST['lage1'],
                    "mobile_number" => $_POST['mobno1'],
                    "email" => $_POST['Email1'],
                    "linkedin" => $_POST['linkedin1'],
                    "resume" => $_FILES['cv1']['name'],
                    "role" => $_POST['role1']
                ),
                array(
                    "full_name" => $_POST['name2'],
                    "age" => $_POST['lage2'],
                    "mobile_number" => $_POST['mobno2'],
                    "email" => $_POST['Email2'],
                    "linkedin" => $_POST['linkedin2'],
                    "resume" => $_FILES['cv2']['name'],
                    "role" => $_POST['role2']
                ),
                array(
                    "full_name" => $_POST['name3'],
                    "age" => $_POST['lage3'],
                    "mobile_number" => $_POST['mobno3'],
                    "email" => $_POST['Email3'],
                    "linkedin" => $_POST['linkedin3'],
                    "resume" => $_FILES['cv3']['name'],
                    "role" => $_POST['role3']
                )
            )
        ),
        "problem_identified" => $_POST['Problem'],
        "value_proposition" => $_POST['Value'],
        "unique_selling_point" => $_POST['sellingpoint'],
        "target_customer_segment" => $_POST['target'],
        "previous_business_experience" => $_POST['exp'],
        "years_of_experience" => $_POST['expyrs'],
        "past_experience_utilization" => $_POST['help'],
        "seed_funding" => $_POST['seed'],
        "market_survey" => $_POST['survey'],
        "target_market" => $_POST['targetmarket'],
        "technology_details" => array(
            "business_dependent_on_technology" => $_POST['a'],
            "technology_origin" => $_POST['b'],
            "technology_development_stage" => $_POST['c'],
            "technology_development_assistance_needed" => $_POST['d'],
            "technology_provider_agency" => $_POST['e']
        ),
        "declaration_accepted" => isset($_POST['finalchk'])
    );

    $uploadDir = 'uploads/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    move_uploaded_file($_FILES['cv']['tmp_name'], $uploadDir . $_FILES['cv']['name']);
    move_uploaded_file($_FILES['plan']['tmp_name'], $uploadDir . $_FILES['plan']['name']);
    move_uploaded_file($_FILES['cv1']['tmp_name'], $uploadDir . $_FILES['cv1']['name']);
    move_uploaded_file($_FILES['cv2']['tmp_name'], $uploadDir . $_FILES['cv2']['name']);
    move_uploaded_file($_FILES['cv3']['tmp_name'], $uploadDir . $_FILES['cv3']['name']);

    $result = $collection->insertOne($data);

    if ($result->getInsertedCount() > 0) {
        echo "Data submitted successfully!";
    } else {
        echo "Error submitting data.";
    }
}
?>
