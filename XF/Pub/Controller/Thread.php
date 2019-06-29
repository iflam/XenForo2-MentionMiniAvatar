<?php

namespace LiamW\MentionMiniAvatar\XF\Pub\Controller;

use LiamW\MentionMiniAvatar\Pub\Controller\MentionMiniAvatarTrait;
use XF\Mvc\ParameterBag;

class Thread extends XFCP_Thread
{
	use MentionMiniAvatarTrait;

	public function actionIndex(ParameterBag $params)
	{
		return $this->addMentionsToContent(parent::actionIndex($params), 'posts');
	}

	protected function getNewPostsReply(\XF\Entity\Thread $thread, $lastDate)
	{
		return $this->addMentionsToContent(parent::getNewPostsReply($thread, $lastDate), 'posts');
	}
}