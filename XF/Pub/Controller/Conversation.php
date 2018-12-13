<?php

namespace LiamW\MentionMiniAvatar\XF\Pub\Controller;

use LiamW\MentionMiniAvatar\Pub\Controller\MentionMiniAvatarTrait;
use XF\Mvc\ParameterBag;

class Conversation extends XFCP_Conversation
{
	use MentionMiniAvatarTrait;

	public function actionView(ParameterBag $params)
	{
		return $this->addMentionsToContent(parent::actionView($params), 'messages');
	}
}