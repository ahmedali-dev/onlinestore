<div class="loginSystem">
    <div class="loginSystem__left">
        <div class="loginSystem__left__imgCenter">
            <img src="./assets/img/left.png" alt="" />
        </div>
    </div>

    <div class="loginSystem__right">
        <div class="loginSystem__right__form">
            <form action="" method="post" class="register">
                <!-- start form -->

                <div class="loginSystem__right__form__header">
                    <h1>Create New Account</h1>
                </div>

                <div class="loginSystem__right__form__group">
                    <label for="name">Full Name:</label>
                    <input oninput="inputActive()" type="text" id="name" class="btn name" name="name" />
                </div>

                <!-- <div class="loginSystem__right__form__alert">
                        <p>name is less than 8 letters</p>
                    </div> -->

                <div class="loginSystem__right__form__group">
                    <label for="email">Email:</label>
                    <input oninput="inputActive()" type="email" name="email" id="email" class="btn email" />
                </div>

                <div class="loginSystem__right__form__group">
                    <label for="password">Password</label>
                    <input oninput="inputActive()" type="password" name="password" id="password" class="btn password" />
                    <i onclick="showPass(this)" class="las la-low-vision"></i>
                </div>

                <div class="loginSystem__right__form__group">
                    <label for="password_repeat">Password repeat</label>
                    <input oninput="inputActive()" type="password" name="password_repeat" id="password_repeat"
                        class="btn password_repeat" />
                    <i onclick="showPass(this)" class="las la-low-vision"></i>
                </div>

                <div class="loginSystem__right__form__group">
                    <div class="loginSystem__right__form__group__cpatcha">
                        <div class="loginSystem__right__form__group__cpatcha__left">
                            <img id="imgcpa" style="height:100%" src="/cpa" alt="">
                        </div>
                        <div class="loginSystem__right__form__group__cpatcha__right">
                            <input class="btn cpatcha" type="text" id="cpa" name="cpatcha" />
                        </div>
                    </div>
                </div>

                <div class="loginSystem__right__form__group">
                    <button class="btn Register">Register</button>
                </div>

                <div class="loginSystem__right__form__foot">
                    <a href="/signin" class="link">You Have a <span>Account ?</span></a>
                </div>

                <!-- end form -->
            </form>
        </div>
    </div>
</div>