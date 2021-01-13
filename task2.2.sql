SELECT
    communities.id AS 'ID',
    communities.name AS 'Название сообщества',
    permissions.name AS 'Название разрешения',
    COUNT(users.id) AS 'Количество пользователей'
FROM users, community_member_permissions, permissions, communities, community_members
WHERE
    community_member_permissions.permission_id = permissions.id AND
    community_member_permissions.member_id = users.id AND
    users.id = community_members.user_id AND
    community_members.community_id = communities.id
GROUP BY permissions.name, communities.id
HAVING COUNT(users.id) >= 5
ORDER BY communities.id DESC, COUNT(users.id) ASC
LIMIT 100
