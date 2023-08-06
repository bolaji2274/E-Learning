<style>
footer{
            width: 100%;
            bottom: 0;
            background: #7a6ad8;
            color: #fff;
            padding: 100px 0 30px;
            border-top-left-radius: 125px;
            font-size: 13px;
            line-height: 18px;
        }
        footer .row{
            width: 85%;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: space-between;
        } 
.col{
            flex-basis: 25%;
            padding: 10px;
        }
        .col:nth-child(2), .col:nth-child(3){
            flex-basis: 15%;
        }
        .logo{
            width: 80px;
            margin-bottom: 30px;
            cursor: pointer;
        }
        .col h3{
            width: fit-content;
            margin-bottom: 40px;
            position: relative;
        }
        .email-id{
            width: fit-content;
            border-bottom: 1px solid #ccc;
            cursor: pointer;
            margin: 20px 0;
        }
        ul li{
            list-style: none;
            margin-bottom: 12px;
        }
        ul li a{
            text-decoration: none;
            color: #fff;
        }
         ul li a:hover{
            padding-left: 20px;
            transition: 0.2s;
        }
        .formm{
            padding-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #ccc;
            margin-bottom: 50px;
        }
        .formm .fa{
            font-size: 18px;
            margin-right: 10px;
        }
        .formm input{
            width: 100%;
            background: transparent;
            color: #ccc;
            border: 0;
            outline: none;
        }
        .formm .bts{
            padding: 4px 6px;
            background: transparent;
            cursor: pointer;
            color: #ccc;
            border: 1px solid #ccc;
        }
        .social-icons .fab{
            display: inline-block;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            font-size: 20px;
            color: #7a6ad8;
            background: #fff;
            margin-right: 8px;
            cursor: pointer;
            transition: all 0.5s ease;

        }
        .social-icons .fab:hover{
            border: 1px solid #ccc;
            transition: 1s ease;
            color: #fff;
            background: #7a6ad8;
        }
        hr{
            width: 90%;
            border: 0;
            border-bottom: 1px solid #ccc;
            margin: 20px auto;
        } 
        .copyright{
            text-align: center;
        }
        .underline{
            width: 100%;
            height: 5px;
            background: #767676;
            border-radius: 3px;
            position: absolute;
            top: 25px;
            left: 0;
            overflow: hidden;
        }
        .underline span{
            width: 15px;
            height: 100%;
            background: #fff;
            border-radius: 3px;
            position: absolute;
            top: 0;
            left: 10px;
            animation: moving 2s linear infinite;
        }
        @keyframes moving{
            0%{
                left: -20px;
            }
            100%{
                left: 100%;
            }
        }
        @media (max-width: 700px) {
            footer{
                bottom: unset;
            }
            .col{
            flex-basis: 100%;
        }
        .col:nth-child(2), .col:nth-child(3){
            flex-basis: 100%;
        }
        }
        #contact-forms input::placeholder {
            color: #fff;
        }
</style>

<footer>
        <div class="row">
            <div class="col">
                <h2 class="logo"><span style="color: #fff;">Ibudo</span><span style="color: blue;">Eko..</span></h2>
                    <li><a href="#" style="color: #fff;">Syeed E-Learning ti o ni ọlọrọ ti awọn orisun, A
                    Jẹ́ kí ẹ̀kọ́ rọrùn kí ó sì rọrùn fún gbogbo ènìyàn.</a></li>
            </div>
            <div class="col">
                <h3 style="font-size: 17px; color: #fff;">ọfiisi  <div class="underline"><span></span></div></h3>
                <li>ITPL Road</li>
                <li>Oke Awesin, Erin Osun</li>
                <li>Osun State, Nigeria.</li>
                <li class="email-id">learners471@gmail.com</li>
                <h4 style="font-size: 17px; color: #fff;">+234 - 9047310968</h4>
            </div>
            <div class="col">
                <h3 style="font-size: 17px; color: #fff;">ìsopọ̀<div class="underline"><span></span></div></h3>
                <ul>
                <li><a href="home.php">Ile</a></li>
                <li><a href="about.php">Nipa wa</a></li>
                <li><a href="courses.php">Awon ẹkọ</a></li>
                <li><a href="teachers.php">Awon olukọ</a></li>
                <li><a href="contact.php">Firan si wa</a></li>
                </ul>
            </div>
            <div class="col">
                <h3 style="font-size: 17px; color: #fff;">Iwe iroyin <div class="underline"><span></span></div></h3>
                <form id="contact-forms" class="formm" action="https://formspree.io/f/mayzrvev" method="post">
                    <i class="fa fa-envelope"></i>
                    <input type="email" name="email" placeholder="Tẹ id Imeeli rẹ sii" maxlength="30" required class="box">
                    <button type="submit" class="bts">firanṣẹ</button>
                </form>
                <div class="social-icons">
                        <a href="facebook.com"><i class="fab fa-facebook-f"></i></a>
                        <a href="twitter.com"><i class="fab fa-twitter"></i></a>
                        <a href="instagram.com"><i class="fab fa-instagram"></i></a>
                        <a href="linkedin.com"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <hr>
        <li class="copyright">&copy; copyright @ <?= date('Y'); ?>  <span style="color: #fff;">Ibudo</span><span style="color: blue;">Eko..</span> | All Rights Reserved!</li>
    </footer>