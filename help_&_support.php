<!DOCTYPE html>

<html>
<head>
    <title>Contact us</title>
    <link rel="stylesheet" href="help_&_support_styles.css">
    
    <style>
        .container{
            background-image:("images/image6.jpg");
        }
        </style>
        
</head>
<body>

   
    <div class="container">
        
        <div class="form">
            <div class="contact-info"><h3 class="title">Let's get in touch !</h3>
            <p class="text">
                Have questions or want to learn more about our services? We're here to help! Get in touch with us today and our team will be happy to assist you. Whether you prefer to give us a call, send an email, or fill out the form below, we look forward to hearing from you.
            </p>
            <div class="info">
            <a href="#">
                <div class="information">
                    <img src="images/image1.png" class="icon" alt="phone">
                    <p>011-2348990</p>
                    
                </div></a>
                <a href="#">
                <div class="information">
                    <img src="images/image2.png" class="icon" alt="address">
                    <p>12/A, Duplication road, Colombo</p>
                </div></a>
                <a href="#">
                <div class="information">
                    <img src="images/image3.png" class="icon" alt="facebook">
                    <p>Finfjobs@solutions.com</p>
                </div></a>

            </div>
            
                
        </div>
        

            <div class="contact-form">
                <span class="circle one"></span>
                <span class="circle two"></span>

                
                <form action="insert.php" method="post">
                    <h3 class="title">Contact us</h3>
                    <div class="input-container ">
                        <input type="text" name="name" class="input">
                        <label for="">Username</label>
                        <span>Username</span>
                    </div>   
                    <div class="input-container ">
                        <input type="email" name="email" class="input">
                        <label for="">E-mail</label>
                        <span>E-mail</span>
                    </div>   
                    <div class="input-container ">
                        <input type="tel" name="phone" class="input">
                        <label for="">Phone</label>
                        <span>Phone</span>
                    </div>   
                    <div class="input-container textarea ">
                        <textarea name="message" class="input"></textarea>
                        <label for="">Message</label>
                        <span>Message</span>
                    </div>  
                    <input type="submit" value="Send" class="btn">

            </div>




        </div>
    </div>


</form>


<script src="app.js"></script>
</body>

</html>