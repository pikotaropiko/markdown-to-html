<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Markdown To Html</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    </head>
    <body>
    <div class="h-screen">
        <h1 class="font-semibold leading-7 text-gray-900 text-center text-lg mb-8">Markdown To HTML</h1>
        <div class="grid grid-cols-2 gap-x-3 h-4/6 justify-evenly px-10">
            <div class="border max-h-full">
                <textarea id="markdown-box" class="block cursor-text w-full h-full p-2 outline-none resize-none" placeholder="Type markdown here"></textarea>
            </div>
            <div class="border max-h-full overflow-auto p-2">
                <h2 class="mb-2 text-base border-b-[1px]">HTML code</h2>
                <div id="html-code" class="overflow-auto max-h-full p-1"></div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-x-3 h-1/6 justify-evenly px-10 mt-8">
            <div class="justify-self-start">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
            <div class="justify-self-end">
                <button onclick="convertMarkdown()" class="cursor-pointer rounded-md bg-indigo-600 text-white px-3 py-2">Convert</button>
            </div>
        </div>
    </div>
    <script>
        function convertMarkdown() {
            let markdown = document.querySelector('#markdown-box').value;
            if (!markdown) {
                return;
            }
            axios.post('/', {markdown})
                .then(response => {
                    //document.querySelector('#html-box').innerHTML = `${response.data.html}`;
                    document.querySelector('#html-code').innerHTML = `<pre>${response.data.encoded_html}<pre>`;
                })
                .catch(err => {
                    console.log(err);
                });
        }
    </script>
    </body>
</html>
