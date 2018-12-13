<?php

namespace LiamW\MentionMiniAvatar\XF\Pub\Controller;

use XF\Mvc\ParameterBag;
use XF\Mvc\Reply\View;

class Thread extends XFCP_Thread
{
	public function actionIndex(ParameterBag $params)
	{
		$reply = parent::actionIndex($params);

		if ($reply instanceof View && $posts = $reply->getParam('posts'))
		{
			$lwMentionsRepo = $this->repository('LiamW\MentionMiniAvatar:Mentions');
			$lwMentionsRepo->addMentionsToContent($posts);
		}

		return $reply;
	}
}