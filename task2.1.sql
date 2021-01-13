SELECT
    users.name,
    communities.name,
    community_members.joined_at
FROM users
    JOIN community_members ON community_members.user_id = users.id
    JOIN communities ON community_members.community_id = communities.id
WHERE communities.created_at > '2013-01-01 00:00:00'
ORDER BY community_members.joined_at;

#Либо

SELECT
    U.name,
    C.name,
    CM.joined_at
FROM users AS U
    JOIN community_members AS CM ON CM.user_id = U.id
    JOIN communities AS C ON CM.community_id = C.id
WHERE C.created_at > '2013-01-01 00:00:00'
ORDER BY CM.joined_at