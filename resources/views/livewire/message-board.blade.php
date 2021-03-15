<div>
    <div x-data="{show:false}"
         x-show="show"
         x-init="Echo.private('self').listenForWhisper('test', (e) => {
                show=true;
                console.log(show)
            });"
         style="display: none">对方正在输入</div>
    <input type="text" x-data @input="Echo.private('self').whisper('test',{name:44})">
    <script>

    </script>
</div>
