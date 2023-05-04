<?php
$title = "Contact Us | Busy Bee Snacks- Bringing Health to the Hive ";
$description = "If you have any questions, please use the contact form to get in touch with us at Busy Bee Snacks. ";
include("header.php");
//connects to db
require_once("connect-db.php");
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first = test_input($_POST["first"]);
    $last = test_input($_POST["last"]);
    $email = test_input($_POST["email"]);
    $phone = test_input($_POST["phone"]);
    $address = test_input($_POST["address"]);
    $rate = test_input($_POST["rate"]);
    $fav = test_input($_POST["fav"]);
    $again = test_input($_POST["again"]);
    $comment = test_input($_POST["comment"]);

    $sql = "insert into contact (first, last, email, phone, address, rate, fav, again, comment) values (:first, :last, :email, :phone, :address, :rate, :fav, :again, :comment)";
    $statement1 = $db->prepare($sql);
    $statement1->bindValue(":first", $first);
    $statement1->bindValue(":last", $last);
    $statement1->bindValue(":email", $email);
    $statement1->bindValue(":phone", $phone);
    $statement1->bindValue(":address", $address);
    $statement1->bindValue(":rate", $rate);
    $statement1->bindValue(":fav", $fav);
    $statement1->bindValue(":again", $again);
    $statement1->bindValue(":comment", $comment);
    if ($statement1->execute()) {
        $account = $statement1->fetchAll();
        $statement1->closeCursor();
?>
<script>
window.location.replace("contact-success.php")
</script>
<?php
    } else {
        echo "<h4>Error entering contact information</h4>";
    }
}
?>
<section class="contact">
    <article>
        <h1>CONTACT US</h1>
        <h4>If you have any questions, please contact us by filling out the contact form.</h4>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="first">First Name</label><br>
            <input type="text" name="first"><br>
            <label for="last">Last Name</label><br>
            <input type="text" name="last"><br>
            <label for="email">Email</label><br>
            <input type="email" name="email"><br>
            <label for="phone">Phone Number</label><br>
            <input type="tel" name="phone"><br>
            <label for="address">Address</label><br>
            <input type="text" name="address"><br>
            <p>Rate your shopping experience</p>
            <input type="radio" id="one-star" name="rate" value="1 star">
            <label for="one-star">1 Star</label><br>
            <input type="radio" id="two-star" name="rate" value="2 star">
            <label for="two-star">2 Star</label><br>
            <input type="radio" id="three-star" name="rate" value="3 star">
            <label for="three-star">3 Star</label><br>
            <input type="radio" id="four-star" name="rate" value="4 star">
            <label for="four-star">4 Star</label><br>
            <input type="radio" id="five-star" name="rate" value="5 star">
            <label for="five-star">5 Star</label><br>
            <div class="space"></div>
            <label for="fav">What is your favorite snack from Busy Bee Snacks</label><br>
            <input type="text" name="fav"><br>
            <p>Would you shop from Busy Bee Snacks again?</p>
            <input type="radio" id="yes" name="again" value="1">
            <label for="yes">Yes</label><br>
            <input type="radio" id="no" name="exp" value="0">
            <label for="no">No :(</label><br>
            <div class="space"></div>
            <label for="comment">Comments</label>
            <br>
            <textarea name="comment"></textarea>
            <button class="btn-primary">Submit</button>
        </form>
        <div class="contact-img">
            <img src="images/Honey.jpg" alt="A picture of a jar of honey">
        </div>
    </article>
</section>
<?php include("footer.php") ?>