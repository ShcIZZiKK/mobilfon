SELECT
    users.name,
    communities.name,
    permissions.name
FROM users, community_members, permissions, communities, community_member_permissions
WHERE
    community_members.user_id = users.id AND
    community_members.community_id = communities.id AND
    community_member_permissions.permission_id = permissions.id AND
    community_member_permissions.member_id = users.id AND
    (users.name LIKE '%T%' OR users.name LIKE '%t%') AND
    permissions.name LIKE '%articles%' AND
    LENGTH(communities.name) >= 15
ORDER BY users.name, communities.name
