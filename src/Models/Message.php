<?php
require_once __DIR__ . '/../../config/database.php';

class Message
{
    public static function getLastMessagesForUser($userId, $limit = 10)
    {
        global $pdo;
        $sql = "
            SELECT m.id, m.sender_id, m.receiver_id, u.username AS sender_name, m.content, m.sent_at
            FROM messages m
            JOIN users u ON u.id = m.sender_id
            WHERE m.sender_id = :uid OR m.receiver_id = :uid
            ORDER BY m.sent_at DESC
            LIMIT :lim
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':uid', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
