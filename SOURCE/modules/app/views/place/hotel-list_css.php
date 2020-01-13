<style>
    .image-object-on-map {
        border: 3px solid #2196f3;
        object-fit: cover;
        position: relative;
    }

    .image-object-on-map:before {
        content: ' ';
        display: block;
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translate(-50%, 3px);
        width: 0;
        height: 0;
        border: 5px solid transparent;
        border-top-color: #2196f3;
    }

    .image-object-on-map img {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }

    .count-cluster {
        position: absolute;
        top: 0;
        right: 0;
        padding: 1px 5px;
        background: #000;
        color: #fff;
        border-radius: 5px;
        transform: translate(70%, -70%);
        font-size: .7rem;
    }
</style>