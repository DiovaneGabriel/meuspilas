<?php $this->load->view('includes/head'); ?>

<body>
    <?php $this->load->view('includes/menu'); ?>
    <div class="container">
        <?php $this->load->view($this->view); ?>
    </div>
    <?php $this->load->view('includes/footer'); ?>

    <?php if ($this->input->get('message')) : ?>
        <?php
        $message = $this->input->get('message');
        $message = json_decode(base64_decode($message));

        echo $message->text;
        ?>
    <?php endif; ?>
</body>

</html>