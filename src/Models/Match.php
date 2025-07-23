<?php
require_once __DIR__ . '/../../config/database.php';

class MatchModel
{
    public static function getMatchesForUser($userId)
    {
        global $pdo;
        $sql = "
            SELECT u.id, u.username, u.email
            FROM matches m
            JOIN users u ON (
                u.id = IF(m.user_id_1 = ?, m.user_id_2, m.user_id_1)
            )
            WHERE m.user_id_1 = ? OR m.user_id_2 = ?
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId, $userId, $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}