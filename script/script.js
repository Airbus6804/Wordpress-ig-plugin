/*
        <form id="ig_data">
            <input type="text" id="ig_username" placeholder="Insert your username">
            <textarea id="ig_description" placeholder="Insert your description"></textarea>
            <input type="file" id="ig_profile_picture">
            <button type="submit">Submit</button>
        </form>
*/


const form = document.getElementById("ig_data");
const username = document.getElementById("ig_username");
const description = document.getElementById("ig_description");
const picture = document.getElementById("ig_profile_picture");
//const igButton = document.getElementById("getDataFromIg");

const preview = document.getElementById("image_preview");


const username_preview = document.getElementById("ig_username_preview");
const description_preview = document.getElementById("ig_description_preview");
const profile_pic_preview = document.getElementById("image_preview_preview")

const fr = new FileReader();


picture.addEventListener("click", () => {
    picture.value = null;
});

picture.addEventListener("change", () => {
    const file = picture.files[0];
    fr.readAsArrayBuffer(file);
    fr.onload = () => {
        const pic = new Uint8Array(fr.result);
        const src = URL.createObjectURL(
            new Blob([pic.buffer], { type: "image/png" } /* (1) */)
        );
        preview.src = src;
        profile_pic_preview.src = src;
    }
});

form.addEventListener("submit", (e) => {
    e.preventDefault();
    console.log(picture.files);

    
        const pic = new Uint8Array(fr.result);

        

        const body = {
            username: username.value,
            biography: description.value,
            external_url: `https://instagram.com/${username.value}/`,
            profile_picture: JSON.stringify(pic),
        };
        console.log(body, pic);

        fetch("/wp-json/ig/saveUsername", {
            method: "POST",
            body: JSON.stringify(body),
        })
            .then((res) => res.text())
            .then(console.log);

});



username.addEventListener("keyup", () => {
    username_preview.innerText = username.value;
})

description.addEventListener("keyup", () => {
    description_preview.innerText = description.value;
});

/*
            <section>
                <h1>Preview</h1>
                <div open preview class="ig_button">
                  <div class="ig_button_upper">
                    <img id="image_preview_preview" src="<?php echo $igData->profile_pic_url ?>" >
                    <span id="ig_username_preview"><?php echo $igData->username?></span>
                  </div>
                  <span id="ig_description_preview" class="ig_button_description">
                    <?php echo $igData->biography ?>
                  </span>
                  

                    </div>
            </section>
*/

/*
        "biography" => $body->biography,
        "external_url" => $body->external_url,
        "profile_pic_url" => $body->profile_pic_url,
        "username" => $body->username
*/
