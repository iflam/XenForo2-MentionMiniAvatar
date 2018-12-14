<?php

namespace LiamW\MentionMiniAvatar\XF\Pub\Controller;

use LiamW\MentionMiniAvatar\Pub\Controller\MentionMiniAvatarTrait;
use XF\Mvc\ParameterBag;

class Member extends XFCP_Member
{
	use MentionMiniAvatarTrait;

	public function actionView(ParameterBag $params)
	{
		if (\XF::$versionId >= 2010031)
		{
			return $this->addMentionsToContent(parent::actionView($params), 'profilePosts');
		}

		return parent::actionView($params);
	}
}