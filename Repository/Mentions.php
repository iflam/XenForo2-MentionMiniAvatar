<?php

namespace LiamW\MentionMiniAvatar\Repository;

use XF\Mvc\Entity\Repository;

class Mentions extends Repository
{
	public function addMentionsToContent($content, $metadataKey = 'embed_metadata', $getterKey = 'LWUserMentions')
	{
		if (!$content)
		{
			return;
		}

		$mentionedUsersIds = [];
		foreach ($content AS $item)
		{
			$metadata = $item->{$metadataKey};
			if (isset($metadata['lwUserMentions']))
			{
				$mentionedUsersIds = array_merge($mentionedUsersIds, $metadata['lwUserMentions']);
			}
		}

		$mentionedUsers = [];
		if ($mentionedUsersIds)
		{
			$mentionedUsers = $this->finder('XF:User')
				->whereIds(array_unique($mentionedUsersIds))
				->fetch();
		}

		if (!$mentionedUsers || !$mentionedUsers->count())
		{
			return;
		}

		foreach ($content AS $item)
		{
			$metadata = $item->{$metadataKey};
			if (isset($metadata['lwUserMentions']))
			{
				$contentMentionedUsers = [];
				foreach ($metadata['lwUserMentions'] AS $id)
				{
					if (!isset($mentionedUsers[$id]))
					{
						continue;
					}
					$contentMentionedUsers[$id] = $mentionedUsers[$id];
				}

				$item->{"set$getterKey"}($contentMentionedUsers);
			}
		}
	}
}