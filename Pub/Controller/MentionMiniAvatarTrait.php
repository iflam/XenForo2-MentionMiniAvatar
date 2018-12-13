<?php

namespace LiamW\MentionMiniAvatar\Pub\Controller;

use XF\Mvc\Reply\AbstractReply;
use XF\Mvc\Reply\View;

trait MentionMiniAvatarTrait
{
	public function addMentionsToContent(AbstractReply $reply, $contentKey)
	{
		if ($reply instanceof View && $content = $reply->getParam($contentKey))
		{
			$this->repository('LiamW\MentionMiniAvatar:Mentions')->addMentionsToContent($content);
		}

		return $reply;
	}
}