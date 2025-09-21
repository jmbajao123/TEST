<!-- Credential Code Modals -->
<?php if(!empty($notifications)): ?>
    <?php foreach($notifications as $index => $notif): ?>
        <?php if($notif['type'] === 'credential'): ?>
            <div class="modal fade" id="notifModal<?php echo $index; ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header bg-warning-subtle text-dark">
                            <h5 class="modal-title"><?php echo htmlspecialchars($notif['title']); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p><?php echo htmlspecialchars($notif['message']); ?></p>
                            <p><strong>New Code:</strong> <?php echo htmlspecialchars($notif['student_vcode']); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>


<!-- AJAX: Mark Credential Code as read -->
<script>
document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('hidden.bs.modal', function () {
        fetch('mark_notif_read.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 's_id=<?php echo $s_id; ?>&type=credential'
        }).then(() => {
            const badge = document.getElementById('notifBadge');
            if (badge) {
                let count = parseInt(badge.innerText);
                if (count > 1) {
                    badge.innerText = count - 1;
                } else {
                    badge.style.display = 'none';
                }
            }
        });
    });
});
</script>