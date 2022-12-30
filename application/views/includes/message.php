<?php if ($this->input->get('message')) : ?>
    <?php
    $message = $this->input->get('message');
    $message = json_decode(base64_decode($message));

    $type = $message->type;
    $message = $message->text;
    ?>
    <div class="message <?= $type; ?>">
        <p><?= $message; ?></p>
    </div>
<?php endif; ?>