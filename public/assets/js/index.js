const request = async (url, obj = {}) => {
    const req = await fetch(url, obj);
    return req.json();
};


const message = (t, tag) => {
    return String.raw`
        <div style='text-transform: capitalize;' class="loginSystem__right__form__alert ${tag}">
          <p>${t}</p>
        </div>
        `;
};

const removemsg = (msg, tag, custom) => {
    if (!custom) {
        const id = tag.id;
        if (msg.msg) {
            try {
                document
                    .querySelector(`.loginSystem__right__form__alert.${id}`)
                    .remove();
            } catch (error) {
            }
            tag.parentElement.insertAdjacentHTML("afterend", message(msg.msg, id));
        } else {
            try {
                document
                    .querySelector(`.loginSystem__right__form__alert.${id}`)
                    .remove();
            } catch (error) {
            }
        }
    } else {
        custom(msg, tag);
    }
};

try {
    document
        .querySelector("form.register")
        .addEventListener("submit", (event) => {
            event.preventDefault();
            let name,
                email,
                pass,
                rePass,
                cpa,
                imgcpa,
                formdata = new FormData();
            name = document.querySelector("#name");
            email = document.querySelector("#email");
            pass = document.querySelector("#password");
            rePass = document.querySelector("#password_repeat");
            cpa = document.querySelector("#cpa");
            imgcpa = document.querySelector("#imgcpa");

            formdata.append("name", name.value);
            formdata.append("email", email.value);
            formdata.append("pass", pass.value);
            formdata.append("rePass", rePass.value);
            formdata.append("cpa", cpa.value);

            const data = request("register", {method: "post", body: formdata}).then(
                (data) => {
                    const {
                        name: rname,
                        email: remail,
                        pass: rpass,
                        rePass: rrepass,
                        cpa: rcpa,
                        success,
                    } = data;
                    try {
                        removemsg(rname, name);
                        removemsg(remail, email);
                        removemsg(rpass, pass);
                        removemsg(rrepass, rePass);
                        removemsg(rcpa, cpa, (msg, tag) => {
                            const id = tag.id;
                            if (msg.msg) {
                                try {
                                    document
                                        .querySelector(`.loginSystem__right__form__alert.${id}`)
                                        .remove();
                                } catch (error) {
                                }
                                tag.parentElement.parentElement.parentElement.insertAdjacentHTML(
                                    "afterend",
                                    message(msg.msg, id)
                                );
                            } else {
                                document
                                    .querySelector(`.loginSystem__right__form__alert.${id}`)
                                    .remove();
                            }
                        });
                    } catch (error) {
                    }
                    if (success) {
                        location = "/home";
                    }
                    imgcpa.src = "/cpa";
                }
            );
        });
} catch (error) {
}

try {
    document.querySelector("form.signin").addEventListener("submit", (event) => {
        event.preventDefault();
        let email,
            pass,
            cpa,
            imgcpa,
            formdata = new FormData();
        email = document.querySelector("#email");
        pass = document.querySelector("#password");
        cpa = document.querySelector("#cpa");
        imgcpa = document.querySelector("#imgcpa");

        formdata.append("email", email.value);
        formdata.append("pass", pass.value);
        formdata.append("cpa", cpa.value);

        const data = request("/signin", {method: "post", body: formdata}).then(
            (data) => {
                try {
                    const {
                        email: remail,
                        pass: rpass,
                        cpa: rcpa,
                        active,
                        success,
                    } = data;

                    try {
                        removemsg(remail, email);
                        removemsg(rpass, pass);
                        removemsg(rcpa, cpa, (msg, tag) => {
                            const id = tag.id;
                            if (msg.msg) {
                                try {
                                    document
                                        .querySelector(`.loginSystem__right__form__alert.${id}`)
                                        .remove();
                                } catch (error) {
                                }
                                tag.parentElement.parentElement.parentElement.insertAdjacentHTML(
                                    "afterend",
                                    message(msg.msg, id)
                                );
                            } else {
                                document
                                    .querySelector(`.loginSystem__right__form__alert.${id}`)
                                    .remove();
                            }
                        });
                        if (active.msg) {
                            document.body.insertAdjacentHTML(
                                "beforeend",
                                `<div style="background-color: white;
            text-transform: capitalize" class="alert ab success">
          <p>${active.msg}</p>
      </div>`
                            );
                            removeAlert();
                        }
                    } catch (error) {
                    }

                    if (success) {
                        location = "/home";
                    }
                    imgcpa.src = "/cpa";
                } catch (error) {
                    console.log(error);
                }
            }
        );
    });
} catch (error) {
}

try {
    document
        .querySelector("form.forget")
        .addEventListener("submit", (event) => {
            event.preventDefault();
            let email = document.querySelector("#email"),
                cpa = document.querySelector("#cpa"),
                formdata = new FormData();

            formdata.append('email', email.value)
            formdata.append('cpa', cpa.value)

            const data = request("/forget", {method: "post", body: formdata}).then(
                (data) => {
                    try {
                        const {
                            email: remail,
                            cpa: rcpa,
                            success,
                        } = data;

                        try {
                            removemsg(remail, email);
                            removemsg(rcpa, cpa, (msg, tag) => {
                                const id = tag.id;
                                if (msg.msg) {
                                    try {
                                        document
                                            .querySelector(`.loginSystem__right__form__alert.${id}`)
                                            .remove();
                                    } catch (error) {
                                    }
                                    tag.parentElement.parentElement.parentElement.insertAdjacentHTML(
                                        "afterend",
                                        message(msg.msg, id)
                                    );
                                } else {
                                    document
                                        .querySelector(`.loginSystem__right__form__alert.${id}`)
                                        .remove();
                                }
                            });
                            if (active.msg) {
                                document.body.insertAdjacentHTML(
                                    "beforeend",
                                    `<div style="background-color: white;
                                                text-transform: capitalize" class="alert ab success">
                                              <p>${active.msg}</p>
                                          </div>`
                                );
                                removeAlert();
                            }
                        } catch (error) {
                        }

                        if (success) {
                            location = "/home";
                        }
                        imgcpa.src = "/cpa";
                    } catch (error) {
                        console.log(error);
                    }
                })

        })
} catch (e) {

}

function inputActive() {
    const inputs = document.querySelectorAll(
        ".loginSystem__right__form__group input"
    );
    const labels = document.querySelectorAll(
        ".loginSystem__right__form__group label"
    );

    for (const input of inputs) {
    }

    inputs.forEach((input, index) => {
        try {
            if (input.value != "") {
                input.classList.add("active");
                labels[index].classList.add("active");
            }
        } catch (error) {
        }
    });
}

setTimeout(() => {
    inputActive();
}, 1000);

const showPass = (e) => {
    const form__group = e.parentElement;
    const input = form__group.getElementsByTagName("input")[0];
    const changeType = input;
    const show = "lar la-eye";
    const unshow = "las la-low-vision";

    if (changeType.type == "password") {
        changeType.type = "text";
        e.classList.value = show;
    } else {
        changeType.type = "password";
        e.classList.value = unshow;
    }
};

const removeAlert = () => {
    let alert = document.querySelectorAll(".alert");
    if (alert) {
        alert.forEach((a) => {
            setTimeout(() => {
                a.remove();
            }, 3000);
        });
    }
};

removeAlert();
